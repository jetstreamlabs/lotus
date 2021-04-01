<?php

namespace Serenity\Lotus\Providers;

use Illuminate\Support\ServiceProvider;
use Serenity\Lotus\Console\AppNameCommand;
use Serenity\Lotus\Console\JobMakeCommand;
use Serenity\Lotus\Console\MailMakeCommand;
use Serenity\Lotus\Console\RuleMakeCommand;
use Serenity\Lotus\Console\EventMakeCommand;
use Serenity\Lotus\Console\ModelMakeCommand;
use Serenity\Lotus\Console\ActionMakeCommand;
use Serenity\Lotus\Console\PolicyMakeCommand;
use Serenity\Lotus\Console\ChannelMakeCommand;
use Serenity\Lotus\Console\ConcernMakeCommand;
use Serenity\Lotus\Console\ConsoleMakeCommand;
use Serenity\Lotus\Console\PayloadMakeCommand;
use Serenity\Lotus\Console\RequestMakeCommand;
use Serenity\Lotus\Console\ServiceMakeCommand;
use Serenity\Lotus\Console\ConcernsMakeCommand;
use Serenity\Lotus\Console\ContractMakeCommand;
use Serenity\Lotus\Console\CriteriaMakeCommand;
use Serenity\Lotus\Console\ListenerMakeCommand;
use Serenity\Lotus\Console\LotusInstallCommand;
use Serenity\Lotus\Console\ObserverMakeCommand;
use Serenity\Lotus\Console\ProviderMakeCommand;
use Serenity\Lotus\Console\ResourceMakeCommand;
use Serenity\Lotus\Console\ComponentMakeCommand;
use Serenity\Lotus\Console\EventGenerateCommand;
use Serenity\Lotus\Console\ExceptionMakeCommand;
use Serenity\Lotus\Console\ResponderMakeCommand;
use Serenity\Lotus\Console\MiddlewareMakeCommand;
use Serenity\Lotus\Console\RepositoryMakeCommand;
use Serenity\Lotus\Console\NotificationMakeCommand;
use Serenity\Lotus\Console\EloquentRepositoryMakeCommand;
use Serenity\Lotus\Console\RepositoryInterfaceMakeCommand;

class ArtisanExtendProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * The commands to be registered.
     *
     * @var array
     */
    protected $devCommands = [
        'ActionMake'             => 'command.action.make',
        'LotusInstall'           => 'command.lotus.install',
        'AppName'                => 'command.app.name',
        'ChannelMake'            => 'command.channel.make',
        'ComponentMake'          => 'command.component.make',
        'ConcernMake'            => 'command.concern.make',
        'ConsoleMake'            => 'command.console.make',
        'ContractMake'           => 'command.contract.make',
        'CriteriaMake'           => 'command.criteria.make',
        'EloquentRepositoryMake' => 'command.eloquent.repository.make',
        'EventGenerate'          => 'command.event.generate',
        'EventMake'              => 'command.event.make',
        'ExceptionMake'          => 'command.exception.make',
        'JobMake'                => 'command.job.make',
        'ListenerMake'           => 'command.listener.make',
        'MailMake'               => 'command.mail.make',
        'MiddlewareMake'         => 'command.middleware.make',
        'ModelMake'              => 'command.model.make',
        'NotificationMake'       => 'command.notification.make',
        'ObserverMake'           => 'command.observer.make',
        'PayloadMake'            => 'command.payload.make',
        'PolicyMake'             => 'command.policy.make',
        'ProviderMake'           => 'command.provider.make',
        'RepositoryInterfaceMake' => 'command.repository.contract.make',
        'RepositoryMake'         => 'command.repository.make',
        'RequestMake'            => 'command.request.make',
        'ResourceMake'           => 'command.resource.make',
        'ResponderMake'          => 'command.responder.make',
        'RuleMake'               => 'command.rule.make',
        'ServiceMake'            => 'command.service.make',
    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerCommands(array_merge(
            $this->devCommands
        ));
    }

    /**
     * Register the given commands.
     *
     * @param  array  $commands
     * @return void
     */
    protected function registerCommands(array $commands)
    {
        foreach (array_keys($commands) as $command) {
            call_user_func_array([$this, "register{$command}Command"], []);
        }

        $this->commands(array_values($commands));
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerActionMakeCommand()
    {
        $this->app->singleton('command.action.make', function ($app) {
            return new ActionMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerLotusInstallCommand()
    {
        $this->app->singleton('command.lotus.install', function ($app) {
            return new LotusInstallCommand($app['composer'], $app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerAppNameCommand()
    {
        $this->app->singleton('command.app.name', function ($app) {
            return new AppNameCommand($app['composer'], $app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerChannelMakeCommand()
    {
        $this->app->singleton('command.channel.make', function ($app) {
            return new ChannelMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerComponentMakeCommand()
    {
        $this->app->singleton('command.component.make', function ($app) {
            return new ComponentMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerConcernMakeCommand()
    {
        $this->app->singleton('command.concern.make', function ($app) {
            return new ConcernMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerConsoleMakeCommand()
    {
        $this->app->singleton('command.console.make', function ($app) {
            return new ConsoleMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerContractMakeCommand()
    {
        $this->app->singleton('command.contract.make', function ($app) {
            return new ContractMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerCriteriaMakeCommand()
    {
        $this->app->singleton('command.criteria.make', function ($app) {
            return new CriteriaMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerEloquentRepositoryMakeCommand()
    {
        $this->app->singleton('command.eloquent.repository.make', function ($app) {
            return new EloquentRepositoryMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerEventGenerateCommand()
    {
        $this->app->singleton('command.event.generate', function () {
            return new EventGenerateCommand;
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerEventMakeCommand()
    {
        $this->app->singleton('command.event.make', function ($app) {
            return new EventMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerExceptionMakeCommand()
    {
        $this->app->singleton('command.exception.make', function ($app) {
            return new ExceptionMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerJobMakeCommand()
    {
        $this->app->singleton('command.job.make', function ($app) {
            return new JobMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerListenerMakeCommand()
    {
        $this->app->singleton('command.listener.make', function ($app) {
            return new ListenerMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerMailMakeCommand()
    {
        $this->app->singleton('command.mail.make', function ($app) {
            return new MailMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerMiddlewareMakeCommand()
    {
        $this->app->singleton('command.middleware.make', function ($app) {
            return new MiddlewareMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerModelMakeCommand()
    {
        $this->app->singleton('command.model.make', function ($app) {
            return new ModelMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerNotificationMakeCommand()
    {
        $this->app->singleton('command.notification.make', function ($app) {
            return new NotificationMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerObserverMakeCommand()
    {
        $this->app->singleton('command.observer.make', function ($app) {
            return new ObserverMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerPayloadMakeCommand()
    {
        $this->app->singleton('command.payload.make', function ($app) {
            return new PayloadMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerPolicyMakeCommand()
    {
        $this->app->singleton('command.policy.make', function ($app) {
            return new PolicyMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerProviderMakeCommand()
    {
        $this->app->singleton('command.provider.make', function ($app) {
            return new ProviderMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerRepositoryInterfaceMakeCommand()
    {
        $this->app->singleton('command.repository.contract.make', function ($app) {
            return new RepositoryInterfaceMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerRepositoryMakeCommand()
    {
        $this->app->singleton('command.repository.make', function ($app) {
            return new RepositoryMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerRequestMakeCommand()
    {
        $this->app->singleton('command.request.make', function ($app) {
            return new RequestMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerResourceMakeCommand()
    {
        $this->app->singleton('command.resource.make', function ($app) {
            return new ResourceMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerResponderMakeCommand()
    {
        $this->app->singleton('command.responder.make', function ($app) {
            return new ResponderMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerRuleMakeCommand()
    {
        $this->app->singleton('command.rule.make', function ($app) {
            return new RuleMakeCommand($app['files']);
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerServiceMakeCommand()
    {
        $this->app->singleton('command.service.make', function ($app) {
            return new ServiceMakeCommand($app['files']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array_merge(array_values($this->devCommands));
    }
}
