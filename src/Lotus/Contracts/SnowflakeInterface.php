<?php

/*
 * Lotus Package for ADR, Inertia, Snowflake support in Laravel ^8.*
 *
 * Copyright (c) Jetstream Labs, LLC. - All Rights Reserved.
 * Licensed under the MIT License (MIT) - https://opensource.org/licenses/MIT
 * Maintained by secondmanveran - Queen Creek, AZ USA
 */

namespace Jetlabs\Lotus\Contracts;

use Jetlabs\Lotus\Snowflake\DriverInterface;

interface SnowflakeInterface
{
	/**
	 * Build and return a new configured Snowflake driver.
	 *
	 * @return \Jetlabs\Lotus\Snowflake\DriverInterface
	 */
	public function make(): DriverInterface;
}
