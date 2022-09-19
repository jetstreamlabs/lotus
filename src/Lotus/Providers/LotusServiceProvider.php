<?php

/*
 * Lotus Package for ADR, Inertia, Snowflake support in Laravel ^8.*
 *
 * Copyright (c) Jetstream Labs, LLC. - All Rights Reserved.
 * Licensed under the MIT License (MIT) - https://opensource.org/licenses/MIT
 * Maintained by secondmanveran - Queen Creek, AZ USA
 */

namespace Jetlabs\Lotus\Providers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Jetlabs\Lotus\Contracts\ResponderInterface;
use Jetlabs\Lotus\Contracts\ResponseFactoryInterface;
use Jetlabs\Lotus\Responders\Vue;

class LotusServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('VERSION', function (Application $app) {
			return '1.0.3';
		});

		$this->mergeConfigFrom(
			__DIR__.'/../../config/lotus.php',
			'lotus'
		);

		$this->app->bind(
	  \Jetlabs\Lotus\Snowflake\ResolverInterface::class,
	  \Jetlabs\Lotus\Snowflake\Resolver::class
	);

		$this->app->bind(
	  \Jetlabs\Lotus\Snowflake\DriverInterface::class,
	  \Jetlabs\Lotus\Snowflake\Driver::class
	);

		$this->rebindLaravelDefaults();
	}

	public function boot()
	{
		$this->registerLaravelAuthModelConfigKey();
		$this->registerProviders();
		$this->registerMiddleware();
		$this->registerMacros();
		$this->registerSnowflakeProvider();

		$this->publishes([
			__DIR__.'/../../config/lotus.php' => config_path('lotus.php'),
		]);
	}

	/**
	 * Register our snowflake classes and service.
	 *
	 * @return void
	 */
	protected function registerSnowflakeProvider()
	{
		$this->app->bind(
	  \Jetlabs\Lotus\Contracts\SnowflakeInterface::class,
	  \Jetlabs\Lotus\Core\Snowflake::class
	);

		$this->app->singleton('snowflake', function (Application $app) {
			return $app->make(\Jetlabs\Lotus\Contracts\SnowflakeInterface::class);
		});
	}

	/**
	 * Register various macros for the app.
	 *
	 * @return void
	 */
	protected function registerMacros()
	{
		Collection::macro('then', function ($callback) {
			return $callback($this);
		});

		Collection::macro('pipe', function ($callback) {
			return $this->then($callback);
		});

		Collection::macro('toAssoc', function () {
			return $this->reduce(function ($assoc, $keyAndValue) {
				[$key, $value] = $keyAndValue;
				$assoc[$key] = $value;

				return $assoc;
			}, new static());
		});

		Collection::macro('mapToAssoc', function ($callback) {
			return $this->map($callback)->toAssoc();
		});

		Collection::macro('transpose', function () {
			$items = array_map(function (...$items) {
				return $items;
			}, ...$this->values());

			return new static($items);
		});

		Builder::macro('scope', function ($scope) {
			return $scope->getQuery($this);
		});
	}

	/**
	 * Register our required middleware.
	 *
	 * @return void
	 */
	protected function registerMiddleware()
	{
		if (! is_file(app_path('Domain/Middleware/MuteActions.php'))) {
			$router = $this->app['router'];
			$router->pushMiddlewareToGroup('web', \Jetlabs\Lotus\Middleware\MuteActions::class);
		}
	}

	/**
	 * Register our additional package service providers.
	 *
	 * @return void
	 */
	protected function registerProviders()
	{
		$this->registerInertiaFactory();
		$this->registerResponseFactory();

		$this->app->singleton('breadcrumb', function (Application $app) {
			return $app->make(\Jetlabs\Lotus\Core\Breadcrumbs::class);
		});
	}

	/**
	 * Register Inertia Responder to pass into the ResponseFactory.
	 *
	 * @return void
	 */
	protected function registerInertiaFactory(): void
	{
		$this->app->bind(ResponderInterface::class, function (Application $app) {
			return $app->make(Vue::class);
		});
	}

	/**
	 * Bind the interface used by the Lotus Facade to our VueResponder concrete.
	 *
	 * @return void
	 */
	protected function registerResponseFactory(): void
	{
		$this->app->singleton(ResponseFactoryInterface::class, function (Application $app) {
			return $app->make(ResponderInterface::class);
		});
	}

	/**
	 * Various processes within Laravel still need access to
	 * the auth.providers.users.model config key which
	 * has been replaced for Jetlabs. This resolves it.
	 *
	 * @return void
	 */
	protected function registerLaravelAuthModelConfigKey(): void
	{
		$this->app['config']->set(
			'auth.providers.users.model',
			$this->app['config']->get('auth.providers.users.entity')
		);
	}

	/**
	 * Controllers and Models don't exist in Jetlabs so
	 * we'll rebind these commands to Actions and Entities
	 * since Laravel squawks if we don't handle it.
	 *
	 * @return void
	 */
	protected function rebindLaravelDefaults(): void
	{
		$this->app->bind(
			'command.controller.make',
			'command.action.make'
		);

		$this->app->bind(
			'command.model.make',
			'command.entity.make'
		);
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
