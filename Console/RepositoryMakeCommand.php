<?php

namespace Serenity\Lotus\Console;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;

class RepositoryMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:repository';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Eloquent repository and interface.';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Repository';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub() {
        //
    }

    /**
     * Execute the console command.
     *
     * @return bool|null
     */
    public function handle()
    {
        $this->createInterface();

        $this->createRepository();
    }

    /**
     * Create an interface for the repo.
     *
     * @return void
     */
    protected function createInterface()
    {
        $interface = Str::studly(class_basename($this->argument('name')) . 'Contract');

        $this->call('make:repository-contract', [
            'name' => "{$interface}"
        ]);
    }

    /**
     * Create an Eloquent repository concrete.
     *
     * @return void
     */
    protected function createRepository()
    {
        $repository = Str::studly(class_basename($this->argument('name')));

        $this->call('make:eloquent-repository', [
            'name' => "{$repository}"
        ]);
    }
}
