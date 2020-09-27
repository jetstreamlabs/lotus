<?php

namespace Serenity\Lotus\Console;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class ModelMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:entity';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Eloquent entity class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Entity';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if (parent::handle() === false && ! $this->option('force')) {
            return;
        }

        if ($this->option('resource')) {
            $this->input->setOption('factory', true);
            $this->input->setOption('migration', true);
            $this->input->setOption('action', true);
        }

        if ($this->option('factory')) {
            $this->createFactory();
        }

        if ($this->option('migration')) {
            $this->createMigration();
        }

        if ($this->option('action')) {
            $this->createAction();
        }
    }

    /**
     * Create a model factory for the model.
     *
     * @return void
     */
    protected function createFactory()
    {
        $factory = Str::studly(class_basename($this->argument('name')));

        $this->call('make:factory', [
            'name' => "{$factory}Factory",
            '--model' => $this->argument('name'),
        ]);
    }

    /**
     * Create a migration file for the model.
     *
     * @return void
     */
    protected function createMigration()
    {
        $table = Str::plural(Str::snake(class_basename($this->argument('name'))));

        $this->call('make:migration', [
            'name' => "create_{$table}_table",
            '--create' => $table,
        ]);
    }

    /**
     * Create an action for the model.
     *
     * @return void
     */
    protected function createAction()
    {
        $action = Str::studly(class_basename($this->argument('name')));

        $modelName = $this->qualifyClass($this->getNameInput());

        $this->call('make:action', [
            'name' => "{$action}Action",
            '--entity' => $this->option('resource') ? $modelName : null,
        ]);
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('pivot')) {
            return __DIR__.'/stubs/pivot.entity.stub';
        }

        return __DIR__.'/stubs/entity.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Domain\Entities';
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['action', 'a', InputOption::VALUE_NONE, 'Create a new action for the entity.'],

            ['factory', 'f', InputOption::VALUE_NONE, 'Create a new factory for the entity.'],

            ['force', null, InputOption::VALUE_NONE, 'Create the class even if the entity already exists.'],

            ['migration', 'm', InputOption::VALUE_NONE, 'Create a new migration file for the entity.'],

            ['pivot', 'p', InputOption::VALUE_NONE, 'Indicates if the generated entity should be a custom intermediate table entity.'],

            ['resource', 'r', InputOption::VALUE_NONE, 'Generate a migration, factory, and action for the entity.'],
        ];
    }
}
