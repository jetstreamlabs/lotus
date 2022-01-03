<?php

/*
 * Lotus Package for ADR, Inertia, Snowflake support in Laravel ^8.*
 *
 * Copyright (c) Jetstream Labs, LLC. - All Rights Reserved.
 * Licensed under the MIT License (MIT) - https://opensource.org/licenses/MIT
 * Maintained by secondmanveran - Queen Creek, AZ USA
 */

namespace Serenity\Lotus\Providers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

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

		$this->rebindLaravelDefaults();
	}

	public function boot()
	{
		$this->registerLaravelAuthModelConfigKey();
		$this->registerMiddleware();
		$this->registerMacros();
		$this->registerProviders();

		$this->publishes([
			__DIR__.'/../../config/lotus.php' => config_path('lotus.php'),
		]);
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
				list($key, $value) = $keyAndValue;
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
		if (!is_file(app_path('Domain/Middleware/InertiaMiddleware.php'))) {
			$router = $this->app['router'];
			$router->pushMiddlewareToGroup('web', \Serenity\Lotus\Middleware\InertiaMiddleware::class);
		}

		if (!is_file(app_path('Domain/Middleware/MuteActions.php'))) {
			$router = $this->app['router'];
			$router->pushMiddlewareToGroup('web', \Serenity\Lotus\Middleware\MuteActions::class);
		}
	}

	/**
	 * Register our additional package service providers.
	 *
	 * @return void
	 */
	protected function registerProviders()
	{
		$this->app->singleton('breadcrumb', function (Application $app) {
			return $app->make(\Serenity\Lotus\Core\Breadcrumbs::class);
		});
	}

	/**
	 * Various processes within Laravel still need access to
	 * the auth.providers.users.model config key which
	 * has been replaced for Serenity. This resolves it.
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
	 * Controllers and Models don't exist in Serenity so
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
