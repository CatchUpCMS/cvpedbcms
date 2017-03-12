<?php namespace cms\Modules\Environments\Domain\Environments\Environments\Repositories;

use Illuminate\Support\Facades\Auth;
use CVEPDB\Settings\Facades\Settings;
use cms\Infrastructure\Abstractions\Requests\FormRequestAbstract;
use cms\Domain\Environments\Environments\Repositories\EnvironmentsRepositoryEloquent as CMSEnvironmentsRepositoryEloquent;
use cms\Domain\Environments\Environments\Presenters\EnvironmentListPresenter;

/**
 * Class EnvironmentsRepository
 * @package cms\Modules\Environments\Domain\Environments\Environments\Repositories
 */
class EnvironmentsRepository extends CMSEnvironmentsRepositoryEloquent
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexBackEnd()
    {
        $this->setPresenter(new EnvironmentListPresenter());

        $this->filterShowWithTrashed();

        $envs = $this
            ->paginate(Settings::get('app.pagination'));

        return cmsview(
            'environments.backend.environments.index',
            [
                'environments' => $envs
            ],
            'environments::'
        );
    }

    /**
     * @param FormRequestAbstract $request
     *
     * @return mixed|\Redirect
     */
    public function storeBackEnd(FormRequestAbstract $request)
    {
        $environment = $this->create([
            'name' => $request->get('name'),
            'reference' => $request->get('reference'),
            'domain' => $request->get('domain'),
        ]);

        $this->link_default_roles_with($environment);

        $this->link_users_with(
            $environment,
            [
                Auth::user()->id
            ]
        );

        return redirect(route('backend.environments.index'))
            ->with('message-success', 'environments/backend.index.modal.add.message.success');
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editBackEnd($id)
    {
        $env = $this->find($id);

        return cmsview(
            'environments.backend.environments.show',
            [
                'environment' => $env
            ],
            'environments::'
        );
    }

    /**
     * @param FormRequestAbstract $request
     * @param                $id
     *
     * @return mixed|\Redirect
     */
    public function updateBackEnd(FormRequestAbstract $request, $id)
    {
        $this->update(
            [
                'name' => $request->get('name'),
                'domain' => $request->get('domain'),
            ],
            $id
        );

        return redirect(route('backend.environments.index'))
            ->with('message-success', 'environments/backend.index.modal.update.message.success');
    }

    /**
     * @param $id
     *
     * @return mixed|\Redirect
     */
    public function destroyBackEnd($id)
    {
        $redirectTo = null;

        try {
            $this->delete($id);

            $redirectTo = redirect(route('backend.environments.index'))
                ->with('message-success', 'environments/backend.index.modal.delete.message.success');
        } catch (\Exception $e) {
            switch ($e->getCode()) {
                case 1: {
                    $redirectTo = redirect(route('backend.environments.index'))
                        ->with('message-error', $e->getMessage());
                    break;
                }
                default: {
                    $redirectTo = redirect(route('backend.environments.index'))
                        ->with('message-error', 'An error occured');
                    break;
                }
            }
        }

        return $redirectTo;
    }

}
