<?php namespace cms\Modules\Installer\Console\Commands;

use cms\Infrastructure\Abstractions\Console\CommandAbstract;
use cms\Modules\Installer\Domain\Installer\Installer\Repositories\InstallerRepository;

/**
 * Class InstallationProcessCommand
 * @package cms\Modules\Installer\Console\Commands
 */
class InstallationProcessCommand extends CommandAbstract
{

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'installer:install-cms';

	/**
	 * The console signature
	 * @var string
	 */
	protected $signature = 'installer:install-cms
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

		$this
			->r_installer
			->consoleInstallationProcess(
				$this->getOutput(),
				$this->argument('db-host'),
				$this->argument('db-name'),
				$this->argument('db-username'),
				$this->argument('db-password'),
				$this->argument('site-name'),
				$this->argument('site-description'),
				$this->argument('site-url'),
				$this->argument('user-civility'),
				$this->argument('user-first-name'),
				$this->argument('user-last-name'),
				$this->argument('user-email')
			);
	}
}
