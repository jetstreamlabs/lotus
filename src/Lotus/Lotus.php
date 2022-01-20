<?php

/*
 * Lotus Package for ADR, Inertia, Snowflake support in Laravel ^8.*
 *
 * Copyright (c) Jetstream Labs, LLC. - All Rights Reserved.
 * Licensed under the MIT License (MIT) - https://opensource.org/licenses/MIT
 * Maintained by secondmanveran - Queen Creek, AZ USA
 */

namespace Jetlabs\Lotus;

use Illuminate\Support\Facades\Facade;

/**
 * @method static void setRootView($name)
 * @method static void share($key, $value = null)
 * @method static array getShared($key = null, $default = null)
 * @method static void version($version)
 * @method static int|string getVersion()
 * @method static Response render($component, $props = [])
 * @method static \Illuminate\Http\Response location($url)
 * @method static LazyProp lazy(callable $callback)
 *
 * @see \Inertia\ResponseFactory
 */
class Lotus extends Facade
{
	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 *
	 * @throws \RuntimeException
	 */
	protected static function getFacadeAccessor()
	{
		return ResponseInterface::class;
	}
}
