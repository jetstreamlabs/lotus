<?php

namespace Serenity\Lotus\Console;

use Illuminate\Console\GeneratorCommand;

class ConcernMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:concern';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new trait.';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Trait';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        parent::handle();
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/trait.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Domain\Concerns';
    }
}
