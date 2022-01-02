<?php

/*
 * Lotus Package for ADR, Inertia, Snowflake support in Laravel ^8.*
 * --------------------------------------------------------------------------
 * Copyright (c) Jetstream Labs, LLC. - All Rights Reserved.
 * Licensed under the MIT License (MIT) - https://opensource.org/licenses/MIT
 * Maintained by secondmanveran - Queen Creek, AZ USA
 */

namespace Serenity\Lotus;

use Illuminate\Support\Facades\Facade;
use Serenity\Lotus\Contracts\ResponseFactoryInterface;

class Lotus extends Facade
{
	/**
	 * Get the registered name of the component.
	 *
	 * @throws \RuntimeException
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		return ResponseFactoryInterface::class;
	}
}
