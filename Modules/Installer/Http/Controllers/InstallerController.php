<?php
namespace cms\Modules\Installer\Http\Controllers;

use Redirect;
use Illuminate\Http\Request;
use cms\Infrastructure\Abstractions\Controllers\FrontendController as Controller;
use cms\Modules\Installer\Http\Requests\InstallerFormRequest;
use cms\Modules\Installer\Domain\Installer\Installer\Repositories\InstallerRepository;

/**
 * Class InstallerController
 * @package Modules\Installer\Http\Controllers
 */
class InstallerController extends Controller
{

    /**
     * @var InstallerRepository|null
     */
    private $r_installer = null;

    /**
     * InstallerController constructor.
     *
     * @param InstallerRepository $r_installer
     */
    public function __construct(
        InstallerRepository $r_installer
    )
    {
        $this->r_installer = $r_installer;
    }

    /**
     * Installer form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $core_url = (
            isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS'])
                ? 'https://'
                : 'http://'
            ) . $_SERVER['SERVER_NAME'];

dd('index');




        return cmsview(
            'index',
            [
                'header' => [
                    'title' => 'installer::installer.meta_title',
                    'description' => 'installer::installer.meta_description',
                ],
                'breadcrumbs' => null,
                'footer' => [
                    'version' => config('cms.version'),
                    'title' => config('cms.site.name'),
                    'url' => config('app.url'),
                ],
                'core_url' => $core_url,
                'civilities' => $this->r_installer->getCivilitiesList()
            ],
            'installer::',
            'installer::'
        );
    }

    /**
     * Step 1
     *
     * If we can connect to the database with form credential we run the
     * install process
     *
     * @param InstallerFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request, InstallerFormRequest $formRequest)
    {
        return $this
            ->r_installer
            ->installationProcess(
                $request,
                $formRequest->get('DB_HOST'),
                $formRequest->get('DB_DATABASE'),
                $formRequest->get('DB_USERNAME'),
                $formRequest->get('DB_PASSWORD'),
                $formRequest->get('APP_SITE_NAME'),
                $formRequest->get('APP_SITE_DESCRIPTION'),
                $formRequest->get('APP_URL'),
                $formRequest->get('civility'),
                $formRequest->get('first_name'),
                $formRequest->get('last_name'),
                $formRequest->get('email'),
                $formRequest->get('email'),
                $formRequest->get('password')
            );
    }

    /**
     * Step 2
     *
     * Run migration based on .env.installer
     *
     * @return Redirect
     */
    public function runMigration(Request $request)
    {
        // Retrieve data from the session
        $session_installer = $request->session()->get('installer_user_admin');

        $this->r_installer->migrate($session_installer);

        return redirect('installer/initialisation');
    }

    /**
     * Step 3
     *
     * Run post migration and configuration actions
     *
     * - add admin user and roles
     *
     * @return Redirect
     */
    public function initialiseProduction(Request $request)
    {

dd('initialiseProduction');

        try {
            // Retrieve data from the session
            $session_installer = $request->session()->get('installer_user_admin');
            // Reset session
            $request->session()->put('installer_user_admin', []);
            $this->r_installer->addUserAdmin($session_installer);

            // xABE todo : Add first Page and first Post (with category)

            $this->r_installer->set_env_as_production();
        } catch (FileException $exception) {
            $this->r_installer->revert_env_to_installer();

            // Todo : write message
            return Redirect::to('installer')
                ->withErrors('installer::installer.error:')
                ->withInput();
        }

        return redirect('/');
    }
}