<?php namespace cms\Modules\Users\Domain\Users\Users\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Login;
use Illuminate\Foundation\Validation\ValidationException;
use Illuminate\Container\Container as Application;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Laravel\Socialite\Facades\Socialite;
use CVEPDB\Addresses\Domain\Addresses\Countries\Country;
use CVEPDB\Addresses\Domain\Addresses\States\State;
use CVEPDB\Addresses\Domain\Addresses\SubStates\SubState;
use cms\Infrastructure\Abstractions\ExcelFileAbstract;
use cms\Modules\Installer\Infrastructure\Abstractions\Requests\FormRequestAbstract;
use cms\Domain\Users\Users\Repositories\UsersRepositoryEloquent as CMSUsersRepositoryEloquent;
use cms\Domain\Environments\Environments\Repositories\EnvironmentsRepositoryEloquent;
use cms\Domain\Users\SocialTokens\Repositories\SocialTokenRepositoryEloquent;
use cms\Domain\Dashboard\Settings\Repositories\SettingsRepository as DashboardSettingsRepository;
use cms\Domain\Users\Users\User;
use cms\Domain\Users\Users\Presenters\UserListPresenter;
use cms\Modules\Users\Domain\Users\Users\Presenters\UserListExcelPresenter;
use cms\Modules\Users\Domain\Users\Users\Presenters\IndexUsersListPresenter;
use cms\Modules\Users\Domain\Users\Users\Events\NewUserRegisteredEvent;
use cms\Domain\Users\Users\Events\UserUpdatedEvent;

/**
 * Class UsersRepositoryEloquent
 * @package cms\Modules\Users\Domain\Users\Users\Repositories
 */
class UsersRepositoryEloquent extends CMSUsersRepositoryEloquent
{

    /**
     * @var DashboardSettingsRepository|null
     */
    protected $r_dashboard = null;

    /**
     * UsersRepositoryEloquent constructor.
     *
     * @param Application $app
     * @param DashboardSettingsRepository $r_dashboard
     * @param EnvironmentsRepositoryEloquent $r_environments
     * @param SocialTokenRepositoryEloquent $r_social_tokens
     */
    public function __construct(
        Application $app,
        DashboardSettingsRepository $r_dashboard,
        EnvironmentsRepositoryEloquent $r_environments,
        SocialTokenRepositoryEloquent $r_social_tokens
    )
    {
        parent::__construct(
            $app,
            $r_environments,
            $r_social_tokens
        );

        $this->r_dashboard = $r_dashboard;
        $this->r_dashboard->setSettingKey('users.dashboard.widgets');
        $this->r_dashboard->setModuleSettingKey('.front.users.dashboard.widgets');
    }


    /**
     * Validate a new user.
     *
     * @param array $user_data The new user information
     *
     * @return \Illuminate\Validation\Validator
     */
    public function validateNewUser($user_data = [])
    {
        return Validator::make(
            $user_data,
            [
                'civility' => 'required|in:madam,miss,mister',
                'last_name' => 'required|max:50',
                'first_name' => 'required|max:50',
                'email' => 'required|email|max:255|unique:users',
                'birth_date' => '',
                'password' => 'required|confirmed|min:6',
            ]
        );
    }

    /**
     * @param User $user
     * @param FormRequestAbstract $request
     *
     * @return object
     */
    /*public function userPrimaryAddress(
        User $user,
        FormRequestAbstract $request
    )
    {
        $country = Country::find($request->get('primary_address_country_id'));
        $state = State::find($request->get('primary_address_state_id'));
        $substate = SubState::find($request->get('primary_address_substate_id'));

        $locator = $country;
        $locator = is_null($state) ? $locator : $state;
        $locator = is_null($substate) ? $locator : $substate;

        if (is_null($user->flaggedAddress('primary'))) {
            return $user->addAddress(
                [
                    'flag' => 'primary',
                    'street' => $request->get('primary_address_street'),
                    'street_extra' => $request->get('primary_address_street_extra'),
                    'city' => $request->get('primary_address_city'),
                    'zip' => $request->get('primary_address_zip'),
                ],
                $locator
            );
        }

        return $user->updateAddress(
            [
                'flag' => 'primary',
                'street' => $request->get('primary_address_street'),
                'street_extra' => $request->get('primary_address_street_extra'),
                'city' => $request->get('primary_address_city'),
                'zip' => $request->get('primary_address_zip'),
            ],
            $locator
        );
    }*/

    /*
     * BackEnd -----------------------------------------------------------------
     * BackEnd -----------------------------------------------------------------
     * BackEnd -----------------------------------------------------------------
     * BackEnd -----------------------------------------------------------------
     * BackEnd -----------------------------------------------------------------
     * BackEnd -----------------------------------------------------------------
     * BackEnd -----------------------------------------------------------------
     */

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getUserLoginBackEnd()
    {
        return cmsview(
            'users.backend.login',
            [
                'social_login' => \Settings::get('users.social.login'),
                'is_registration_allowed'
                => \Settings::get('users.is_registration_allowed'),
            ],
            'users::'
        );
    }

    /**
     * @param FormRequestAbstract $request
     * @param bool $usePartial
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexUsersListBackEnd(
        FormRequestAbstract $request,
        $usePartial = false
    )
    {
        $name = $request->has('name')
            ? $request->get('name')
            : null;

        $email = $request->has('email')
            ? $request->get('email')
            : null;

        $roles = $request->has('roles')
            ? $request->get('roles')
            : null;

        $trashed = $request->has('trashed')
            ? $request->get('trashed')
            : null;

        $environments = $request->has('environments')
            ? $request->get('environments')
            : [];

        $this->setPresenter(new IndexUsersListPresenter());

        if (!cmsuser_can_see_env()) {
            $environments = [\Environments::currentId()];
        }

        $this->filterEnvironments($environments);

        if (!is_null($name)) {
            $this->filterUserName($name);
        }

        if (!is_null($email)) {
            $this->filterEmail($email);
        }

        if (!is_null($roles)) {
            $this->filterRoles($roles);
        }

        if (!is_null($trashed)) {
            switch ($trashed) {
                case 'with_trashed':
                    $this->filterShowWithTrashed();
                    break;
                case 'only_trashed':
                    $this->filterShowOnlyTrashed();
                    break;
                default:
                    // Display active users only
            }
        }

        $users = $this->with(['environments', 'roles'])
            ->paginate(
                \Settings::get('app.pagination'),
                [
                    'users.id',
                    'users.first_name',
                    'users.last_name',
                    'users.email',
                    'users.deleted_at'
                ]
            );

        return cmsview(
            $usePartial
                ? 'users.backend.users.chunks.index_tables'
                : 'users.backend.users.index',
            [
                'users' => $users,
                'nb_users' => $this->count(),
                'user_can_see_env' => true,
                'is_role_management_allowed' => \Settings::get('users.is_role_management_allowed'),
                'filters' => [
                    'name' => $name,
                    'email' => $email,
                    'roles' => $roles,
                    'environments' => $environments,
                ]
            ],
            'users::'
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createNewUserBackEnd()
    {
        return cmsview(
            'users.backend.users.create',
            [
                'civilities' => $this->getCivilitiesList(),
                'user_can_see_env' => cmsuser_can_see_env()
            ],
            'users::'
        );
    }

    /**
     * Store new user.
     *
     * @param FormRequestAbstract $request
     *
     * @return mixed
     */
    public function storeNewUserBackEnd(FormRequestAbstract $request)
    {
        $birth_date = '0000-00-00';
        $environments = $request->only('environments');
        $roles = $request->only('roles');

        if ($request->has('birth_date')) {
            $birth_date = Carbon::createFromFormat(
                trans('global.date_format'),
                $request->get('birth_date')
            );
            $birth_date = $birth_date->format('Y-m-d');
        }

        $user = $this->create_user(
            $request->get('civility'),
            $request->get('first_name'),
            $request->get('last_name'),
            $request->get('email'),
            $birth_date
        );

        //$this->userPrimaryAddress($user, $request);

        if (
            true //cmsuser_can_see_env()
            && (
                array_key_exists('environments', $environments)
                && !empty($environments['environments'])
                && is_array($environments['environments'])
            )
        ) {
            $user->environments()->sync($environments['environments']);
        }

        if (
            array_key_exists('roles', $roles)
            && !empty($roles['roles'])
            && is_array($roles['roles'])
        ) {
            $user->roles()->sync($roles['roles']);
        }

        return redirect(route('backend.users.index'))
            ->with('message-success', 'users::backend.create.message.success');
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showUserBackEnd($id)
    {
        $this->setPresenter(new UserListPresenter());

        $user = $this->find($id);

        return cmsview(
            'users.backend.users.show',
            [
                'user' => $user,
                'user_can_see_env' => cmsuser_can_see_env()
            ],
            'users::'
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     *
     * @return mixed
     */
    public function editUserBackEnd($id)
    {
        $this->setPresenter(new UserListPresenter());

        $user = $this->find($id);

        return cmsview(
            'users.backend.users.edit',
            [
                'user' => $user,
                'civilities' => $this->getCivilitiesList(),
                'user_can_see_env' => cmsuser_can_see_env()
            ],
            'users::'
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function updateUserBackEnd($id, FormRequestAbstract $request)
    {
        $birth_date = '0000-00-00';
        $environments = $request->only('environments');
        $roles = $request->only('roles');

        if ($request->has('birth_date')) {
            $birth_date = Carbon::createFromFormat(
                trans('global.date_format'),
                $request->get('birth_date')
            );
            $birth_date = $birth_date->format('Y-m-d');
        }

        $user = $this->update([
            'civility' => $request->get('civility'),
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'birth_date' => $birth_date
        ], $id);

        //$this->userPrimaryAddress($user, $request);

        if (
            true //cmsuser_can_see_env()
            && (
                array_key_exists('environments', $environments)
                && !empty($environments['environments'])
                && is_array($environments['environments'])
            )
        ) {
            $user->environments()->sync($environments['environments']);
        }

        if (
            array_key_exists('roles', $roles)
            && !empty($roles['roles'])
            && is_array($roles['roles'])
        ) {
            $user->roles()->sync($roles['roles']);
        }

        return redirect(route('backend.users.index'))
            ->with('message-success', 'users::backend.edit.message.success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroyUserBackEnd($id)
    {
        $redirectTo = redirect(route('backend.users.index'));

        try {
            $this->findAndDelete($id);
            $redirectTo->with('message-success', 'users::backend.delete.message.success');
        } catch (\Exception $e) {
            $redirectTo->with('message-error', $e->getMessage());
            Log::error($e);
        }

        return $redirectTo;
    }

    /**
     * Remove the specified resource(s) from storage.
     *
     * @param FormRequestAbstract $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroyMultipleUserBackEnd(FormRequestAbstract $request)
    {
        $errors = 0;
        $redirectTo = redirect(route('backend.users.index'));
        $users = $request->only('users_multi_destroy');

        foreach ($users['users_multi_destroy'] as $user_id) {
            try {
                $this->findAndDelete($user_id);
            } catch (\Exception $e) {
                $redirectTo = $redirectTo->with('message-error', $e->getMessage());
                Log::error($e);
                ++$errors;
            }
        }

        return 0 === $errors
            ? $redirectTo->with('message-success', 'users::backend.delete_multiple.message.success')
            : $redirectTo;
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function impersonateUserSessionBackEnd($id)
    {
        session()->set('impersonate_member', $id);

        return redirect(route('home'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function endImpersonateUserSessionBackEnd()
    {
        session()->forget('impersonate_member');

        return redirect(route('admin'));
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function resetPasswordUserBackEnd($id)
    {
        $response = $this->send_reset_password_link($id);

        switch ($response) {
            case Password::RESET_LINK_SENT: {
                session()->flash(
                    'message-success',
                    trans('passwords.message_success_reset_password')
                );
                break;
            }
            case Password::INVALID_USER:
            default: {
                session()->flash(
                    'message-success',
                    trans('passwords.message_error_reset_password')
                );
            }
        }

        return redirect(route('backend.users.index'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexBackEndSettings()
    {
        $this->r_dashboard->checkWidgetsList();

        return cmsview(
            'users.backend.settings.index',
            [
                'social_login' => \Settings::get('users.social.login'),
                'is_registration_allowed' => \Settings::get('users.is_registration_allowed'),
                'is_role_management_allowed' => \Settings::get('users.is_role_management_allowed'),
                'widgets' => $this->r_dashboard->allWidgets()
            ],
            'users::'
        );
    }

    /**
     * @param FormRequestAbstract $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function storeBackEndSettings(FormRequestAbstract $request)
    {
        $is_registration_allowed = $request->get('is_registration_allowed');
        \Settings::set('users.is_registration_allowed', !is_null($is_registration_allowed));

        $is_role_management_allowed = $request->get('is_role_management_allowed');
        \Settings::set('users.is_role_management_allowed', !is_null($is_role_management_allowed));

        $social_login = $request->get('social_login');
        \Settings::set('users.social.login', is_array($social_login) ? $social_login : []);

        $widgets = $request->get('widgets');
        $this->r_dashboard->activate($widgets);

        return redirect(route('backend.users.settings.index'));
    }

    /**
     * @param ExcelFileAbstract $excel
     *
     * @return mixed
     */
    public function exportUsersListBackEnd(ExcelFileAbstract $excel)
    {
        $user_can_see_env = true; //cmsuser_can_see_env();

        $this->setPresenter(new UserListExcelPresenter());

        if (!$user_can_see_env) {
            // Force filter on current environment
            $this->filterEnvironments([\Environments::currentId()]);
        }

        $users = $this
            ->with(['roles'])
            ->all($this->fields);

        $nb_users = $this->count();

        return $excel->setTitle(trans('users::backend.export.users_list.title'))
            ->setCreator(Auth::user()->full_name)
            ->setDescription(
                \Settings::get('cms.site.name') . PHP_EOL . \Settings::get('cms.site.description')
            )
            ->sheet(
                sprintf(trans('users::backend.export.users_list.sheet_title'), date('Y-m-d H\hi')),
                function ($sheet) use ($users, $nb_users, $user_can_see_env) {

                    /*
                     * Header
                     */

                    $header = [
                        '#',
                        trans('global.civility'),
                        trans('global.last_name'),
                        trans('global.first_name'),
                        trans('global.email'),
                        trans('global.birth_date'),
                        trans('global.role_s'),
                    ];

                    if ($user_can_see_env) {
                        $header[] = trans('global.environment_s');
                    }

                    $header[] = trans('global.addresse_s');

                    $sheet->prependRow($header);

                    /*
                     * Data
                     */

                    // Append row after row 2
                    $sheet->rows($users['data']);

                    // Append row after row 2
                    $sheet->appendRow(
                        $nb_users + 2,
                        [
                            sprintf(
                                trans('users::backend.export.total_users'),
                                $nb_users
                            )
                        ]
                    );

                    /*
                     * Style
                     */

                    // Set black background
                    $sheet->row(1, function ($row) {
                        // Set font
                        $row
                            ->setFont([
                                'size' => '14',
                                'bold' => true,
                            ])
                            ->setAlignment('center')
                            ->setValignment('middle');
                    });

                    // Freeze first row
                    $sheet->freezeFirstRow();

                    $sheet->cells('A2:F' . ($nb_users + 2), function ($cells) {
                        // Set font
                        $cells
                            ->setFont([
                                'size' => '12',
                                'bold' => false,
                                'wrap-text' => true, // Allow PHP_EOL
                            ])
                            ->setAlignment('center')
                            ->setValignment('middle');
                    });

                    $sheet->row($nb_users + 2, function ($row) {
                        // Set font
                        $row
                            ->setFont([
                                'size' => '12',
                                'bold' => true,
                            ])
                            ->setAlignment('center')
                            ->setValignment('middle');
                    });
                }
            )->export('xls');
    }

    /*
     * FrontEnd ----------------------------------------------------------------
     * FrontEnd ----------------------------------------------------------------
     * FrontEnd ----------------------------------------------------------------
     * FrontEnd ----------------------------------------------------------------
     * FrontEnd ----------------------------------------------------------------
     * FrontEnd ----------------------------------------------------------------
     * FrontEnd ----------------------------------------------------------------
     */

    /**
     * Create a new user.
     *
     * @param array $user_data
     *
     * @return User
     * @throws ValidationException
     */
    public function registerNewUserWithRedirection(
        $user_data = [],
        $guard = null,
        $redirect_uri = '/'
    )
    {

        $pwd = $user_data['password'];

        $user = User::create([
            'last_name' => $user_data['last_name'],
            'first_name' => $user_data['first_name'],
            'email' => $user_data['email'],
            'password' => bcrypt($pwd),
            'role' => User::ROLE_USER
        ]);



        /*$user = $this->store_user(
            $user_data['first_name'],
            $user_data['last_name'],
            $user_data['email']
        );*/

        //$this->set_user_password($user->id, '', $user_data['password']);

        event(new NewUserRegisteredEvent($user));

        Auth::guard($guard)->login($user);

        return redirect($redirect_uri);
    }


    /**
     * Store new user.
     *
     * @param FormRequestAbstract $request
     *
     * @return mixed
     */
    public function store_user($first_name, $last_name, $email, $request)
    {
        $roles = $request->only('roles');

        $user = User::create([
            'last_name' => $last_name,
            'first_name' => $first_name,
            'email' => $email,
            'password' => bcrypt('secret'),
            'role' => User::ROLE_USER
        ]);

        /*$this->userPrimaryAddress($user, $request);

        if (
            true //cmsuser_can_see_env()
            && (
                array_key_exists('environments', $environments)
                && !empty($environments['environments'])
                && is_array($environments['environments'])
            )
        ) {
            $user->environments()->sync($environments['environments']);
        }*/

        if (
            array_key_exists('roles', $roles)
            && !empty($roles['roles'])
            && is_array($roles['roles'])
        ) {
            $user->roles()->sync($roles['roles']);
        }

        return $user;
    }




    /**
     * @param string $uri
     *
     * @return string
     */
    public function redirectAfterAuthentication(
        Request $request,
        User $user,
        $redirect_uri = '/'
    )
    {
//		if (
//			$user->hasRole(RolesRepositoryEloquent::ADMIN)
//			|| $user->hasPermission(PermissionsRepositoryEloquent::ACCESS_ADMIN_PANEL)
//		)
//		{
//			$redirect_uri = 'backend';
//		}
//		else if ($user->hasRole(RolesRepositoryEloquent::USER))
//		{
//			$redirect_uri = $redirect_uri;
//		}
//		else
//		{
//			// xABE Todo : #10 when user login on a site where the environment is none linked to his account, open a request to active the account
//			$redirect_uri = $redirect_uri;
//		}

        return redirect()->intended($redirect_uri);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function redirectUserToHisProfile()
    {
        return redirect('users/my-profile');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function showUserProfileFrontEnd()
    {
        if (Auth::check()) {
            $user = $this->find(Auth::user()->id);

            $widgets = $this->r_dashboard->activeWidgets();

            return cmsview(
                'users.frontend.users.show',
                [
                    'user' => $user,
                    //'role' => $user->role,
                    'widgets' => $widgets
                ],
                'users::'
            );
        }

        return abort(404);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function editUserProfileFrontEnd()
    {
        if (Auth::check()) {
            $this->setPresenter(new UserListPresenter());

            $user = $this->find(Auth::user()->id);

            return cmsview(
                'users.frontend.users.edit',
                [
                    'user' => $user,
                    'civilities' => $this->getCivilitiesList()
                ],
                'users::'
            );
        }

        return abort(404);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function updateUserProfileFrontEnd(FormRequestAbstract $request)
    {
        if (Auth::check()) {
            $birth_date = '0000-00-00';

            if ($request->has('birth_date')) {
                $birth_date = Carbon::createFromFormat(
                    trans('global.date_format'),
                    $request->get('birth_date')
                );
                $birth_date = $birth_date->format('Y-m-d');
            }

            $user = $this->update([
                'civility' => $request->get('civility'),
                'first_name' => $request->get('first_name'),
                'last_name' => $request->get('last_name'),
                'email' => $request->get('email'),
                'birth_date' => $birth_date
            ], Auth::user()->id);

            //$this->userPrimaryAddress($user, $request);

            return redirect(route('users.my-profile'))
                ->with('message-success', 'users::frontend.edit.message.success');
        }

        return abort(404);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function editUserPasswordFrontEnd()
    {
        if (Auth::check()) {
            $user = $this->find(Auth::user()->id);

            return cmsview(
                'users.frontend.users.edit_password',
                [
                    'user' => $user
                ],
                'users::'
            );
        }

        return abort(404);
    }

    /**
     * @param FormRequestAbstract $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function updateUserPasswordFrontEnd(FormRequestAbstract $request)
    {
        if (Auth::check()) {
            $old_password = $request->get('old_password');
            $new_password = $request->get('password');

            if ($this->set_user_password(Auth::user()->id, $old_password, $new_password)) {
                return redirect(route('users.my-profile'))
                    ->with('message-success', 'users::frontend.passwords.change.message.success');
            }

            return redirect(route('users.edit-my-password'))
                ->with('message-error', 'users::frontend.passwords.change.message.error_old_password');
        }

        return abort(404);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getUserLoginFrontEnd()
    {
        return cmsview(
            'users.frontend.login',
            [
                //'social_login' => \Settings::get('users.social.login'),
                'is_registration_allowed' => true,
            ],
            'users::'
        );
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getUserRegistrationFrontEnd()
    {
        return cmsview(
            'users.frontend.register',
            [
                //'social_login' => \Settings::get('users.social.login'),
                //'civilities' => $this->getCivilitiesList(),
                'is_registration_allowed' => true,
            ],
            'users::'
        );
    }

    /**
     * @param $provider
     *
     * @return mixed
     */
    public function redirectToProviderForAuthentification($provider)
    {
        $provider = Socialite::driver($provider);

        //$provider->redirectUrl(route('home'));

        // linkedin
        // $provider->scopes(['r_basicprofile', 'r_emailaddress', 'w_share']);

        // facebook
        // $provider->scopes(['public_profile', 'email', 'publish_actions'])

        // twitter
        // $provider->scopes([])

        return $provider->redirect();
    }

    /**
     * @param        $provider
     * @param string $redirect_uri
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function handleProviderCallbackForAuthentificationWithRedirect(
        $provider,
        $redirect_uri = '/'
    )
    {
        $social_user = Socialite::driver($provider)->user();

        $social_token = $this->r_social_tokens->findByField(
            'token',
            $social_user->token
        )->first();

        if (!is_null($social_token)) {
            $user = $this->find($social_token->user_id);

            Auth::login($user);

            event(new Login($user, true));
        } else {
            if (Auth::check()) {
                $this->r_social_tokens->create([
                    'provider' => $provider,
                    'token' => $social_user->token,
                    'user_id' => Auth::user()->id
                ]);

                session()->flash('message-success', trans('auth.message_success_provider_linked'));
            } else if (\Settings::get('users.is_registration_allowed')) {
                session()->set('register_from_social', [
                    'token' => $social_user->token
                ]);

                return redirect('register/' . $provider);
            } else {
                session()->flash('message-warning', trans('auth.message_warning_registration_not_allowed'));
            }
        }

        return redirect($redirect_uri);
    }

    /**
     * @param $provider
     *
     * @return mixed
     */
    public function getRegisterFromProvider($provider)
    {
        return cmsview(
            'users.frontend.register',
            [
                'provider' => $provider,
                'uri' => '/register/' . $provider
            ],
            'users::'
        );
    }

    /**
     * @param Request $request
     * @param         $provider
     * @param         $redirect_uri
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws ValidationException
     */
    public function postRegisterFromProviderWithRedirect(
        Request $request,
        $provider,
        $guard,
        $redirect_uri
    )
    {
        // xABE Todo : check if email already exists, then redirect to link account

        $user = $this->create($request->all());

        $social_user = session()->get('register_from_social');

        // xABE Todo : check token doesn't exist - no duplicate token

        $this->r_social_tokens->create([
            'provider' => $provider,
            'token' => $social_user['token'],
            'user_id' => $user->id
        ]);

        Auth::guard($guard)->login($user);

        session()->set('register_from_social', []);

        session()->flash(
            'message-success',
            trans('auth.message_success_provider_register_and_loggedin')
        );

        return redirect($redirect_uri);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function formToResetPassword()
    {
        return cmsview(
            'users.frontend.passwords.email',
            [
                'is_registration_allowed'
                => \Settings::get('users.is_registration_allowed'),
            ],
            'users::'
        );
    }

    /**
     * @param $token
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function emailToResetPassword($token)
    {
        if (is_null($token)) {
            throw new NotFoundHttpException;
        }

        return cmsview(
            'users.frontend.passwords.reset',
            [
                'token' => $token,
                'is_registration_allowed'
                => \Settings::get('users.is_registration_allowed'),
            ],
            'users::'
        );
    }

    /**
     * @param string $response
     * @param string $redirect_uri
     *
     * @return mixed
     */
    public function successToResetPassword($response, $redirect_uri)
    {
        session()->flash(
            'message-success',
            trans('passwords.message_success_reset_password')
        );

        return redirect($redirect_uri)
            ->with('status', trans($response));
    }

    /**
     * @param  \Illuminate\Contracts\Auth\CanResetPassword $user
     * @param  string $password
     */
    public function resetUserPassword($user, $password, $guard)
    {
        $user->password = bcrypt($password);
        $user->save();

        /*
         * $user is instance of \cms\Domain\Users\Users\User
         * Here we need instance of \Modules\Users\Entities\User
         */

        $event_user = User::findOrFail($user->id);
        event(new UserUpdatedEvent($event_user));

        /*
         * Log user in
         */

        Auth::guard($guard)->login($user);
    }
}
