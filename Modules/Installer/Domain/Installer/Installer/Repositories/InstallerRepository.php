<?php
namespace cms\Modules\Installer\Domain\Installer\Installer\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Filesystem\FileException;
use Illuminate\Filesystem\FileNotFoundException;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use cms\Domain\Environments\Environments\Repositories\EnvironmentsRepositoryEloquent;
use cms\Domain\Files\Files\Repositories\ElFinderDiskRepository;
use cms\Domain\Users\Users\Repositories\UsersRepositoryEloquent;

/**
 * Class InstallerRepository
 * @package cms\Modules\Installer\Domain\Installer\Installer\Repositories
 */
class InstallerRepository
{

    /**
     * @var UsersRepositoryEloquent|NULL
     */
    private $r_users = null;

    /**
     * @var EnvironmentsRepositoryEloquent|NULL
     */
    private $r_environments = null;

    /**
     * @var ElFinderDiskRepository|NULL
     */
    private $r_disks = null;

    /**
     * InstallerRepository constructor.
     *
     * @param UsersRepositoryEloquent $r_users
     * @param EnvironmentsRepositoryEloquent $r_environments
     * @param ElFinderDiskRepository $r_disks
     */
    public function __construct(
        UsersRepositoryEloquent $r_users,
        EnvironmentsRepositoryEloquent $r_environments,
        ElFinderDiskRepository $r_disks
    )
    {
        $this->r_users = $r_users;
        $this->r_environments = $r_environments;
        $this->r_disks = $r_disks;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getCivilitiesList()
    {
        return $this->r_users->getCivilitiesList();
    }

    /**
     * Installer Process for command line.
     *
     * @param $console_output
     * @param $db_host
     * @param $db_name
     * @param $db_username
     * @param $db_password
     * @param $site_name
     * @param $site_description
     * @param $site_url
     * @param $user_civility
     * @param $user_first_name
     * @param $user_last_name
     * @param $user_email
     */
    public function consoleInstallationProcess(
        $console_output,
        $db_host,
        $db_name,
        $db_username,
        $db_password,
        $site_name,
        $site_description,
        $site_url,
        $user_civility,
        $user_first_name,
        $user_last_name,
        $user_email
    )
    {
        try {
            if (cmsinstalled()) {
                throw new \Exception('The CMS is already installed!');
            }

            $success = $this
                ->testDBConnection(
                    $db_host,
                    $db_name,
                    $db_username,
                    $db_password
                );

            if ($success) {

                $this->generateConfigs(
                    $site_name,
                    $site_description,
                    $site_url,
                    $db_host,
                    $db_name,
                    $db_username,
                    $db_password,
                    $user_first_name,
                    $user_last_name,
                    $user_email
                );

                Artisan::call('cache:clear');
                Artisan::call('config:clear');

                $this->migrate(
                    [
                        'APP_SITE_NAME' => $site_name,
                        'APP_URL' => $site_url
                    ],
                    ['--force' => true, '--database' => 'installer'],
                    ['--force' => true, '--database' => 'installer']
                );

                $password = $this->r_users->generateUserPassword();

                $this->addUserAdmin([
                    'civility' => $user_civility,
                    'first_name' => $user_first_name,
                    'last_name' => $user_last_name,
                    'email' => $user_email,
                    'password' => $password
                ]);

                $this->set_env_as_production();

                $console_output->write(
                    sprintf(
                        trans('installer::installer.command_line_show_password'),
                        $user_email,
                        $password
                    )
                );
                $console_output->write(
                    trans('installer::installer.command_line_remember_change_password')
                );
            } else {
                $console_output->error(
                    trans('installer::installer.error:db_connection')
                );
            }
        } catch (InvalidArgumentException $e) {
            $console_output->error($e->getMessage());
        } catch (\Exception $e) {
            $console_output->error($e->getMessage());
        }
    }

    /**
     * Installer Process for command line.
     *
     * @param $db_host
     * @param $db_name
     * @param $db_username
     * @param $db_password
     * @param $site_name
     * @param $site_description
     * @param $site_url
     * @param $user_civility
     * @param $user_first_name
     * @param $user_last_name
     * @param $user_email
     * @param $user_password
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function installationProcess(
        Request $request,
        $db_host,
        $db_name,
        $db_username,
        $db_password,
        $site_name,
        $site_description,
        $site_url,
        $user_civility,
        $user_first_name,
        $user_last_name,
        $user_email,
        $user_password
    )
    {
        try {
            if (
            $this->testDBConnection(
                $db_host,
                $db_name,
                $db_username,
                $db_password
            )
            ) {
                // Write DB config in .env.installer
                $this->generateConfigs(
                    $site_name,
                    $site_description,
                    $site_url,
                    $db_host,
                    $db_name,
                    $db_username,
                    $db_password,
                    $user_first_name,
                    $user_last_name,
                    $user_email
                );

                Artisan::call('cache:clear');
                Artisan::call('config:clear');

                // Store admin user in session
                $request
                    ->session()
                    ->put('installer_user_admin', [
                        'civility' => $user_civility,
                        'first_name' => $user_first_name,
                        'last_name' => $user_last_name,
                        'email' => $user_email,
                        'password' => $user_password,
                        'APP_SITE_NAME' => $site_url,
                        'APP_URL' => $site_url
                    ]);
            } else {
                return \Redirect::to('installer')
                    ->withErrors([
                        'db_connection' => 'installer::installer.error:db_connection'
                    ])
                    ->withInput();
            }
        } catch (FileNotFoundException $exception) {
            // Todo : write message
            return \Redirect::to('installer')
                ->withErrors('installer::installer.error:')
                ->withInput();

            die ("The file doesn't exist");
        } catch (FileException $exception) {
            // Todo : write message
            return \Redirect::to('installer')
                ->withErrors('installer::installer.error:')
                ->withInput();

            die ("Impossible to write in file");
        }

        return redirect('installer/migration');
    }

    /**
     * Try the DB connection with form credentials
     *
     * @param string $host DB Hostname
     * @param string $database DB name
     * @param string $username DB username
     * @param string $password DB password
     *
     * @return bool
     */
    protected function testDBConnection(
        $host,
        $database,
        $username,
        $password,
        $socket = null
    )
    {
        $isConnected = false;

        try {
            \Config::set('database.connections.installer', [
                'driver' => 'mysql',
                'host' => $host,
                'database' => $database,
                'username' => $username,
                'password' => $password,
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix' => '',
                'strict' => false,
                'engine' => null,
                'unix_socket' => env('DB_SOCKET', $socket),
            ]);

            \DB::connection('installer')->select(DB::raw("SELECT 1"));

            $isConnected = true;
        } catch (\Exception $e) {
            $isConnected = false;
        }

        return $isConnected;
    }

    /**
     * Complete the installer env file with DB info and create the production
     * env file.
     *
     * @param $site_name
     * @param $site_description
     * @param $site_url
     * @param $db_host
     * @param $db_database
     * @param $db_username
     * @param $db_password
     * @param $user_first_name
     * @param $user_last_name
     * @param $user_mail
     */
    protected function generateConfigs(
        $site_name,
        $site_description,
        $site_url,
        $db_host,
        $db_database,
        $db_username,
        $db_password,
        $user_first_name,
        $user_last_name,
        $user_mail
    )
    {
        $this->add_db_info_in_installer_env(
            $db_host,
            $db_database,
            $db_username,
            $db_password
        );
        $this->create_production_env_file(
            $site_name,
            $site_description,
            $site_url,
            $db_host,
            $db_database,
            $db_username,
            $db_password,
            $user_first_name,
            $user_last_name,
            $user_mail
        );
    }

    /**
     * Migrate module and core.
     *
     * @param array $session_installer
     * @param array $migrate_opt
     * @param array $seeder_opt
     *
     * @seealso InstallerRepository::testDBConnection()
     */
    public function migrate(
        array $session_installer,
        array $migrate_opt = ['--force' => true],
        array $seeder_opt = ['--force' => true]
    )
    {
        \Artisan::call('module:publish-migration');
        \Artisan::call('migrate', $migrate_opt);

        $this->addEnvironment($session_installer);

        \Artisan::call('db:seed', $seeder_opt);

        $this
            ->r_disks
            ->addFileSystemDisk(
                'backups',
                [
                    'driver' => 'local',
                    'root' => storage_path('app/default/backups'),
                ],
                EnvironmentsRepositoryEloquent::DEFAULT_ENVIRONMENT_REFERENCE
            );

        $this
            ->r_disks
            ->mountElFinderDisk(
                'backups',
                [
                    'alias' => 'Backups',
                    'URL' => null,
                    'access' => [
                        'readonly' => true,
                        'roles' => [],
                        'permissions' => []
                    ]
                ],
                EnvironmentsRepositoryEloquent::DEFAULT_ENVIRONMENT_REFERENCE
            );
    }

    /**
     * Use production env
     *
     * @throws \Illuminate\Filesystem\FileException
     */
    public function set_env_as_production()
    {
        $bytes_written = File::put(base_path('.env'), 'production' . PHP_EOL);
        if ($bytes_written === false) {
            throw new FileException;
        }
    }

    /**
     * Delete .env and .env.production to rollback to installer env
     */
    public function revert_env_to_installer()
    {
        \File::delete(base_path('.env'));
        \File::delete(base_path('.env.production'));
    }

    /**
     * @param array $session_installer ['APP_URL', 'APP_SITE_NAME']
     */
    public function addEnvironment(array $session_installer)
    {
        // Remove trailing slash
        if (substr($session_installer['APP_URL'], -1) == '/') {
            $session_installer['APP_URL'] = substr(
                $session_installer['APP_URL'],
                0,
                -1
            );
        }

        $this->r_environments->create([
            'name' => $session_installer['APP_SITE_NAME'],
            'reference' => EnvironmentsRepositoryEloquent::DEFAULT_ENVIRONMENT_REFERENCE,
            'domain' => $this->r_environments->get_domain_from_url(
                $session_installer['APP_URL']
            ),
        ]);

        \Environments::loadEnvironment();
    }

    /**
     * Record first roles [user,admin] and the admin user
     *
     * @param array $session_installer
     *
     * @return bool
     * @throws \Exception
     */
    public function addUserAdmin(array $session_installer)
    {
        $user = $this->r_users->createNewAdmin(
            $session_installer['civility'],
            $session_installer['first_name'],
            $session_installer['last_name'],
            $session_installer['email']
        );

        $this->r_users->setUserPassword(
            $user->id,
            null,
            $session_installer['password'],
            true
        );

        $this->r_users->setUserEnvironments(
            $user,
            [
                EnvironmentsRepositoryEloquent::DEFAULT_ENVIRONMENT_REFERENCE
            ]
        );

        return true;
    }

    /**
     * Add DB info in installer config for migration
     *
     * @param string $db_host
     * @param string $db_database
     * @param string $db_username
     * @param string $db_password
     *
     * @throws \Illuminate\Filesystem\FileException
     */
    private function add_db_info_in_installer_env(
        $db_host,
        $db_database,
        $db_username,
        $db_password
    )
    {
        $contents = \File::get(base_path('.env.installer'));


dd($contents);

        if (!Str::contains($contents, 'DB_CONNECTION')) {
            $contents = sprintf("%s\nDB_CONNECTION=mysql\n", $contents);
        }

        if (!Str::contains($contents, 'DB_HOST')) {
            $contents = sprintf("%s\nDB_HOST=%s\n", $contents, $db_host);
        } else {
            $contents = preg_replace("#DB_HOST=(.*)\n#", sprintf("DB_HOST=%s\n", $db_host), $contents);
        }

        if (!Str::contains($contents, 'DB_DATABASE')) {
            $contents = sprintf("%s\nDB_DATABASE=%s\n", $contents, $db_database);
        } else {
            $contents = preg_replace("#DB_DATABASE=(.*)\n#", sprintf("DB_DATABASE=%s\n", $db_database), $contents);
        }

        if (!Str::contains($contents, 'DB_USERNAME')) {
            $contents = sprintf("%s\nDB_USERNAME=%s\n", $contents, $db_username);
        } else {
            $contents = preg_replace("#DB_USERNAME=(.*)\n#", sprintf("DB_USERNAME=%s\n", $db_username), $contents);
        }

        if (!Str::contains($contents, 'DB_PASSWORD')) {
            $contents = sprintf("%s\nDB_PASSWORD=%s\n", $contents, $db_password);
        } else {
            $contents = preg_replace("#DB_PASSWORD=(.*)\n#", sprintf("DB_PASSWORD=%s\n", $db_password), $contents);
        }

        $bytes_written = File::put(base_path('.env.installer'), $contents);
        if ($bytes_written === false) {
            throw new FileException;
        }
    }

    /**
     * Create production env file
     *
     * @param string $site_name
     * @param string $site_description
     * @param string $site_url
     * @param string $db_host
     * @param string $db_database
     * @param string $db_username
     * @param string $db_password
     * @param string $user_first_name
     * @param string $user_last_name
     * @param string $user_mail
     *
     * @throws \Illuminate\Filesystem\FileException
     */
    private function create_production_env_file(
        $site_name,
        $site_description,
        $site_url,
        $db_host,
        $db_database,
        $db_username,
        $db_password,
        $user_first_name,
        $user_last_name,
        $user_mail
    )
    {
        $contents = 'APP_ENV=production' . PHP_EOL;
        $contents .= 'APP_DEBUG=TRUE' . PHP_EOL;
        $contents .= 'APP_KEY=' . hash('md5', time() . date('Y-m-d', time())) . PHP_EOL;
        $contents .= 'APP_INSTALLED=TRUE' . PHP_EOL;
        $contents .= 'APP_SITE_NAME="' . $site_name . '"' . PHP_EOL;
        $contents .= 'APP_SITE_DESCRIPTION="' . $site_description . '"' . PHP_EOL;
        $contents .= 'APP_URL="' . $site_url . '"' . PHP_EOL;
        $contents .= PHP_EOL;
        $contents .= 'CACHE_DRIVER=array' . PHP_EOL;
        $contents .= PHP_EOL;
        $contents .= 'DB_CONNECTION=mysql' . PHP_EOL;
        $contents .= 'DB_HOST=' . $db_host . PHP_EOL;
        $contents .= 'DB_DATABASE=' . $db_database . PHP_EOL;
        $contents .= 'DB_USERNAME=' . $db_username . PHP_EOL;
        $contents .= 'DB_PASSWORD=' . $db_password . PHP_EOL;

        if (!empty(env('DB_SOCKET'))) {
            $contents .= 'DB_SOCKET=' . env('DB_SOCKET') . PHP_EOL;
        }

        $contents .= PHP_EOL;
        $contents .= 'APP_CONTACT_MAIL=' . $user_mail . PHP_EOL;
        $contents .= 'APP_CONTACT_DISPLAY_NAME="' . $user_first_name . ' ' . $user_last_name . '"' . PHP_EOL;

        $bytes_written = File::put(base_path('.env.production'), $contents);

        if ($bytes_written === false) {
            throw new FileException;
        }
    }
}
