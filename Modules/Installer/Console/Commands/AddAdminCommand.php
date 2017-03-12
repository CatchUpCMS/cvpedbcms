<?php namespace cms\Modules\Installer\Console\Commands;

use Illuminate\Support\Str;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Input\InputOption;
use cms\Infrastructure\Abstractions\Console\CommandAbstract;
use cms\Modules\Installer\Domain\Installer\Installer\Repositories\InstallerRepository;

/**
 * Class AddAdminCommand
 * @package cms\Modules\Installer\Console\Commands
 */
class AddAdminCommand extends CommandAbstract
{

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'installer:add-admin';

	/**
	 * The console signature
	 * @var string
	 */
	protected $signature = 'installer:add-admin
     {user-civility : The civility for the admin user account - madam, miss or mister}
	 {user-first-name : The first name for the admin user account}
	 {user-last-name : The last name for the admin user account}
	 {user-email : The email for the admin user account}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Add an user admin';

	/**
	 * @var InstallerRepository|null
	 */
	protected $r_installer = null;

	/**
	 * AddAdminCommand constructor.
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

			if (!cmsinstalled())
			{
				throw new \Exception('The CMS is not installed!');
			}

			$password = Str::random(8);

			$this->r_installer->addUserAdmin([
				'civility'   => $this->argument('user-civility'),
				'first_name' => $this->argument('user-first-name'),
				'last_name'  => $this->argument('user-last-name'),
				'email'      => $this->argument('user-email'),
				'password'   => $password
			]);

			$this->line('<comment>Password associated to ' . $this->argument('user-email') . ' : ' . $password . '</comment>');
			$this->line('<comment>Do not forget to change this password after your first connection!</comment>');
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
