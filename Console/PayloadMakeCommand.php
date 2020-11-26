<?php

namespace Serenity\Lotus\Console;

use Illuminate\Console\GeneratorCommand;

class PayloadMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:payload';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new payload class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Payload';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/payload.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Domain\Payloads';
    }
}
