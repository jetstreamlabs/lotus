<?php

namespace Serenity\Lotus\Console;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;

class ResponderMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:responder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new responder class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Responder';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/responder.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Responders';
    }
}
