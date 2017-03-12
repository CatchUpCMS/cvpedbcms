<?php namespace cms\Modules\Installer\Console\Commands;

use Illuminate\Support\Str;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Input\InputOption;
use CVEPDB\Settings\Facades\Settings;
use cms\Infrastructure\Abstractions\Console\CommandAbstract;
use cms\Modules\Installer\Domain\Installer\Installer\Repositories\InstallerRepository;

/**
 * Class InstallerCommand
 * @package cms\Modules\Installer\Console\Commands
 */
class InstallerCommand extends CommandAbstract
{

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'installer:install';

	/**
	 * The console signature
	 * @var string
	 */
	protected $signature = 'installer:install
	 {site-name : This is your web application name}
	 {site-description : This is your web application description}
	 {site-url : This is your web application link}
	 {user-civility : The civility for the admin user account - madam, miss or mister}
	 {user-first-name : The first name for the admin user account}
	 {user-last-name : The last name for the admin user account}
	 {user-email : The email for the admin user account}
	 {db-host : The database hostname}
	 {db-name : The database name}
	 {db-username : The database hostname}
	 {db-password : The database password}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command line installer';

	/**
	 * @var InstallerRepository|null
	 */
	protected $r_installer = null;

	/**
	 * InstallerCommand constructor.
	 *
	 * @param InstallerRepository $r_installer
	 */
	public function __construct(InstallerRepository $r_installer)
	{
		parent::__construct();
		$this->r_installer = $r_installer;
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function handle()
	{
		parent::fire();

		try
		{
			if (cmsinstalled())
			{
				throw new \Exception('The CMS is already installed!');
			}

			$success = $this->r_installer->testDBConnection(
				$this->argument('db-host'),
				$this->argument('db-name'),
				$this->argument('db-username'),
				$this->argument('db-password')
			);

			if ($success)
			{

				$this->r_installer->generateConfigs(
					$this->argument('site-name'),
					$this->argument('site-description'),
					$this->argument('site-url'),
					$this->argument('db-host'),
					$this->argument('db-name'),
					$this->argument('db-username'),
					$this->argument('db-password'),
					$this->argument('user-first-name'),
					$this->argument('user-last-name'),
					$this->argument('user-email')
				);

				$this->call('cache:clear');

				$this->r_installer->migrate(
					[
						'APP_SITE_NAME' => $this->argument('site-name'),
						'APP_URL'       => $this->argument('site-url')
					],
					['--force' => true, '--database' => 'installer'],
					['--force' => true, '--database' => 'installer']
				);

				$password = Str::random(Settings::get('installer.password_length'));

				$this->r_installer->addUserAdmin([
					'civility'   => $this->argument('user-civility'),
					'first_name' => $this->argument('user-first-name'),
					'last_name'  => $this->argument('user-last-name'),
					'email'      => $this->argument('user-email'),
					'password'   => $password
				]);

				$this->r_installer->set_env_as_production();

				$this->line(sprintf(
					trans('installer::installer.command_line_show_password'),
					$this->argument('user-email'),
					$password
				));
				$this->line(trans('installer::installer.command_line_remember_change_password'));
			}
			else
			{
				$this->error(trans('installer::installer.error:db_connection'));
			}
		}
		catch (InvalidArgumentException $e)
		{
			$this->error($e->getMessage());
		}
		catch (\Exception $e)
		{
			$this->error($e->getMessage());
		}
	}

}
