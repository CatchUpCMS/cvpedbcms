<?php namespace cms\Modules\Users\Http\Controllers\Frontend;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use cms\Infrastructure\Abstractions\Controllers\FrontendController;
use cms\Modules\Users\Domain\Users\Users\Repositories\UsersRepositoryEloquent;
use cms\Domain\Users\Users\User;

/**
 * Class RegisterController
 * @package cms\Modules\Users\Http\Controllers\Frontend
 */
class RegisterController extends FrontendController
{

    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * @var UsersRepositoryEloquent|null
     */
    protected $r_users = null;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UsersRepositoryEloquent $r_users)
    {
        $this->middleware('guest');
        $this->r_users = $r_users;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     *
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param Request $request
     *
     * @return User
     */
    public function register(Request $request)
    {
        $validator = $this->r_users->validateNewUser($request->all());

        /*if ($validator->fails()) {
            $this->throwValidationException(
                $request,
                $validator
            );
        }*/


        //dd($request);


        return $this->r_users
            ->registerNewUserWithRedirection(
                $request->all(),
                $this->guard(),
                $this->redirectPath()
            );
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return $this->r_users->getUserRegistrationFrontEnd();
    }

    /**
     * @param $provider
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getRegisterFromProvider($provider)
    {
        return $this->r_users
            ->getRegisterFromProvider(
                $provider
            );
    }

    /**
     * @param Request $request
     * @param         $provider
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postRegisterFromProvider(Request $request, $provider)
    {
        $validator = $this->r_users->validateNewUser($request->all());

        /*if ($validator->fails()) {
            $this->throwValidationException(
                $request,
                $validator
            );
        }*/

        return $this->r_users
            ->postRegisterFromProviderWithRedirect(
                $request,
                $provider,
                $this->guard(),
                $this->redirectPath()
            );
    }
}
