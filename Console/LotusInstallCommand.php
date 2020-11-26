<?php

namespace Serenity\Lotus\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Composer;
use Symfony\Component\Finder\Finder;
use Illuminate\Filesystem\Filesystem;

class LotusInstallCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'lotus:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set Lotus namespace and move/remove needed files. This cannot be undone.';

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
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
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
        $this->files->deleteDirectory(__DIR__.'/../install');

        $this->info('Lotus is set up for your application, WOOT!');
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
                __DIR__.'/../install/app',
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
                __DIR__.'/../install/web.php',
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
                __DIR__.'/../install/resources',
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
                __DIR__.'/../install/database',
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
                __DIR__.'/../install/webpack.mix.js',
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
                __DIR__.'/../install/package.json',
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
            __DIR__.'/../install/lotus.php',
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
            $this->currentRoot.'\\Http',
            $this->currentRoot.'\\Console',
            $this->currentRoot.'\\Exceptions',
        ];

        $replace = [
            $this->currentRoot.'\\Domain',
            $this->currentRoot.'\\Domain\Console',
            $this->currentRoot.'\\Domain\Exceptions',
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
            $this->currentRoot.'\\Providers',
            'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider'
        ];

        $replace = [
            $this->currentRoot.'\\Domain\\Providers',
            'Serenity\\Lotus\\Providers\\ConsoleSupportServiceProvider'
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
            $this->currentRoot.'\\User',
            $this->currentRoot.'\\Domain\Entities\User'
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
            $this->currentRoot.'\\User',
            $this->currentRoot.'\\Domain\Entities\User'
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
        return $this->laravel->bootstrapPath().'/app.php';
    }

    /**
     * Get the path to the given configuration file.
     *
     * @param  string  $name
     * @return string
     */
    protected function getConfigPath($name)
    {
        return $this->laravel['path.config'].'/'.$name.'.php';
    }
}
