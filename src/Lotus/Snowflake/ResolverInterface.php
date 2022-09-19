<?php

/*
 * Lotus Package for ADR, Inertia, Snowflake support in Laravel ^8.*
 *
 * Copyright (c) Jetstream Labs, LLC. - All Rights Reserved.
 * Licensed under the MIT License (MIT) - https://opensource.org/licenses/MIT
 * Maintained by secondmanveran - Queen Creek, AZ USA
 */

namespace Jetlabs\Lotus\Snowflake;

interface ResolverInterface
{
	/**
	 * The snowflake.
	 *
	 * @param  int|string  $currentTime  current request ms
	 * @return int
	 */
	public function sequence(int $currentTime): int;
}
