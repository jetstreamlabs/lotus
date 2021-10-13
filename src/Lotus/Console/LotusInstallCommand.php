<?php

namespace Serenity\Lotus\Console;

use Faker\Generator;
use Illuminate\Console\Command;
use Illuminate\Support\Composer;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class LotusInstallCommand extends Command
{
	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'serenity:install';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Install Serenity ADR framework into your application.';

	/**
	 * The Composer class instance.
	 *
	 * @var \Illuminate\Support\Composer
	 */
	protected $composer;

	/**
	 * The filesystem instance.
	 *
	 * @var \Illuminate\Filesystem\Filesystem
	 */
	protected $files;

	/**
	 * Current root application namespace.
	 *
	 * @var string
	 */
	protected $currentRoot;

	protected $messageSection;

	protected $barSection;

	protected $faker;

	/**
	 * Install files and overwrite all needed paths.
	 *
	 * @param  \Illuminate\Support\Composer  $composer
	 * @param  \Illuminate\Filesystem\Filesystem  $files
	 * @return void
	 */
	public function __construct(Composer $composer, Filesystem $files)
	{
		parent::__construct();

		$this->files = $files;
		$this->composer = $composer;

		$consoleOutput = app(ConsoleOutput::class);

		$this->messageSection = $consoleOutput->section();
		$this->barSection = $consoleOutput->section();

		$this->faker = app(Generator::class);
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$this->output->write(PHP_EOL .
			"<fg=cyan>
   _____					  _ __	   
  / ___/___  ________  ____  (_) /___  __
  \__ \/ _ \/ ___/ _ \/ __ \/ / __/ / / /
 ___/ /  __/ /  /  __/ / / / / /_/ /_/ / 
/____/\___/_/   \___/_/ /_/_/\__/\__, /  
								/____/   </>" . PHP_EOL . PHP_EOL);

		$this->line("<fg=cyan>The VITAL Stack PHP Framework for fellow Artisans</>");
		$this->newline(2);
		$this->line("<fg=cyan>Thanks for interest in Serenity and I hope you enjoy coding with it.</>");
		$this->line("<fg=cyan>-- Vince K :: Product Creator</>");


		$this->newLine(2);
		$this->line("<fg=red>Make sure you have a clean Laravel 8.x installation.</>");
		$this->line("<fg=red>Any existing files WILL be nuked completely.</>");
		$this->newLine();
		$this->error(">>> THIS CANNOT BE UNDONE! <<<");

		if ($this->confirm("Are you absolutely sure? There's no turning back!")) {
			$this->newLine(2);
			$this->messageSection->overwrite("<fg=cyan>Serenity is being installed.</>" . "\n");
			$this->bar = $this->generateProgressBar(13);
			$this->progressSim();
			//$this->executeInstall();
		}
	}

	public function progressSim()
	{
		$this->bar->start();

		for ($i = 0; $i < 13; $i++) {
			$this->temp($i);
			$this->bar->advance();
		}

		$this->bar->finish();

		$this->newLine(3);
		$this->line("<fg=cyan>Congratulations! Serenity is now installed and you're ready to go.</>");
		$this->line("<fg=cyan>Welcome to Coding Zen =) If you like what I've built please consider sponsoring the project.</>");
		$this->newLine();
		$this->line("<fg=cyan>Now get your butt to work and create something beautiful.</>");
		$this->output->write(PHP_EOL . "<fg=red>
					..... (¯`v´¯)♥
					.......•.¸.•´
					....¸.•´
					.. (
					 ☻/
					/▌♥♥
					/ \ ♥♥ </>" . PHP_EOL . PHP_EOL);

		$this->newLine(2);
	}

	public function temp($item)
	{
		usleep(rand(1000000, 6000000));
		$this->messageSection->overwrite("<fg=cyan>" . $this->faker->sentence() . "</> \n");
		return true;
	}

	public function executeInstall()
	{
		$this->currentRoot = trim($this->laravel->getNamespace(), '\\');

		$this->setBootstrapNamespaces();

		$this->moveAppDirectory();
		$this->moveRouteFile();
		$this->moveResourcesDirectory();
		$this->moveDatabaseDirectory();
		$this->movePackageFile();
		$this->moveWebpackFile();
		$this->moveConfigFile();

		$this->setConfigNamespaces();

		$this->composer->dumpAutoloads();

		$this->call('clear-compiled');

		// once we're all done remove the install directory
		$this->files->deleteDirectory(__DIR__ . '/../install');

		$this->info('Serenity is set up for your application, WOOT!');
	}

	/**
	 * Remove the old directory and move the adr app directory.
	 *
	 * @return void
	 */
	protected function moveAppDirectory()
	{
		if ($this->files->isDirectory(base_path('app'))) {
			$this->files->deleteDirectory(base_path('app'));

			$this->files->moveDirectory(
				__DIR__ . '/../install/app',
				base_path('app')
			);
		}
	}

	/**
	 * Remove the old route file and move the new one.
	 *
	 * @return void
	 */
	protected function moveRouteFile()
	{
		if ($this->files->isFile(base_path('routes') . '/web.php')) {
			$this->files->delete(base_path('routes') . '/web.php');

			$this->files->move(
				__DIR__ . '/../install/web.php',
				base_path('routes') . '/web.php'
			);
		}
	}

	/**
	 * Remove the old resources directory and move the new one.
	 *
	 * @return void
	 */
	protected function moveResourcesDirectory()
	{
		if ($this->files->isDirectory(base_path('resources'))) {
			$this->files->deleteDirectory(base_path('resources'));

			$this->files->moveDirectory(
				__DIR__ . '/../install/resources',
				base_path('resources')
			);
		}
	}

	/**
	 * Remove the old database directory and move the new one.
	 *
	 * @return void
	 */
	protected function moveDatabaseDirectory()
	{
		if ($this->files->isDirectory(base_path('database'))) {
			$this->files->deleteDirectory(base_path('database'));

			$this->files->moveDirectory(
				__DIR__ . '/../install/database',
				base_path('database')
			);
		}
	}

	/**
	 * Replace old webpack mix file with new one.
	 *
	 * @return void
	 */
	protected function moveWebpackFile()
	{
		if ($this->files->isFile(base_path('webpack.mix.js'))) {
			$this->files->delete(base_path('webpack.mix.js'));

			$this->files->move(
				__DIR__ . '/../install/webpack.mix.js',
				base_path('webpack.mix.js')
			);
		}
	}

	/**
	 * Replace old package.json mix file with new one.
	 *
	 * @return void
	 */
	protected function movePackageFile()
	{
		if ($this->files->isFile(base_path('package.json'))) {
			$this->files->delete(base_path('package.json'));

			$this->files->move(
				__DIR__ . '/../install/package.json',
				base_path('package.json')
			);
		}
	}

	/**
	 * Replace old config file (if exists) or publish lotus.php
	 *
	 * @return void
	 */
	protected function moveConfigFile()
	{
		if ($this->files->isFile(config_path('lotus.php'))) {
			$this->files->delete(config_path('lotus.php'));
		}

		$this->files->move(
			__DIR__ . '/../install/lotus.php',
			config_path('lotus.php')
		);
	}

	/**
	 * Set the bootstrap namespaces.
	 *
	 * @return void
	 */
	protected function setBootstrapNamespaces()
	{
		$search = [
			$this->currentRoot . '\\Http',
			$this->currentRoot . '\\Console',
			$this->currentRoot . '\\Exceptions',
		];

		$replace = [
			$this->currentRoot . '\\Domain',
			$this->currentRoot . '\\Domain\Console',
			$this->currentRoot . '\\Domain\Exceptions',
		];

		$this->replaceIn($this->getBootstrapPath(), $search, $replace);
	}

	/**
	 * Set the namespace in the appropriate configuration files.
	 *
	 * @return void
	 */
	protected function setConfigNamespaces()
	{
		$this->setAppConfigNamespaces();
		$this->setAuthConfigNamespace();
		$this->setServicesConfigNamespace();
	}

	/**
	 * Set the application provider namespaces.
	 *
	 * @return void
	 */
	protected function setAppConfigNamespaces()
	{
		$search = [
			$this->currentRoot . '\\Providers',
			'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider'
		];

		$replace = [
			$this->currentRoot . '\\Domain\\Providers',
			'Serenity\\Generators\\Providers\\ConsoleSupportServiceProvider'
		];

		$this->replaceIn($this->getConfigPath('app'), $search, $replace);
	}

	/**
	 * Set the authentication User namespace.
	 *
	 * @return void
	 */
	protected function setAuthConfigNamespace()
	{
		$this->replaceIn(
			$this->getConfigPath('auth'),
			$this->currentRoot . '\\User',
			$this->currentRoot . '\\Domain\Entities\User'
		);
	}

	/**
	 * Set the services User namespace.
	 *
	 * @return void
	 */
	protected function setServicesConfigNamespace()
	{
		$this->replaceIn(
			$this->getConfigPath('services'),
			$this->currentRoot . '\\User',
			$this->currentRoot . '\\Domain\Entities\User'
		);
	}

	/**
	 * Replace the given string in the given file.
	 *
	 * @param  string  $path
	 * @param  string|array  $search
	 * @param  string|array  $replace
	 * @return void
	 */
	protected function replaceIn($path, $search, $replace)
	{
		if ($this->files->exists($path)) {
			$this->files->put($path, str_replace($search, $replace, $this->files->get($path)));
		}
	}

	/**
	 * Get the path to the bootstrap/app.php file.
	 *
	 * @return string
	 */
	protected function getBootstrapPath()
	{
		return $this->laravel->bootstrapPath() . '/app.php';
	}

	/**
	 * Get the path to the given configuration file.
	 *
	 * @param  string  $name
	 * @return string
	 */
	protected function getConfigPath($name)
	{
		return $this->laravel['path.config'] . '/' . $name . '.php';
	}

	protected function generateProgressBar(int $max)
	{
		$progressBar = new ProgressBar($this->barSection, $max);
		$progressBar->setFormat(
			sprintf("<fg=cyan>%s</>", "%current%/%max% %bar% %percent:3s%%")
		);


		if ('\\' !== \DIRECTORY_SEPARATOR || 'Hyper' === getenv('TERM_PROGRAM')) {
			$progressBar->setEmptyBarCharacter('░'); // light shade character \u2591
			$progressBar->setProgressCharacter('');
			$progressBar->setBarCharacter('▓'); // dark shade character \u2593
		}

		return $progressBar;
	}
}
