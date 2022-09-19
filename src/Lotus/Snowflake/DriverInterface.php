<?php

/*
 * Lotus Package for ADR, Inertia, Snowflake support in Laravel ^8.*
 *
 * Copyright (c) Jetstream Labs, LLC. - All Rights Reserved.
 * Licensed under the MIT License (MIT) - https://opensource.org/licenses/MIT
 * Maintained by secondmanveran - Queen Creek, AZ USA
 */

namespace Jetlabs\Lotus\Snowflake;

interface DriverInterface
{
	/**
	 * Get snowflake id.
	 *
	 * @return string
	 */
	public function id(): string;

	/**
	 * Parse snowflake id.
	 *
	 * @param  string  $id
	 * @param  bool  $transform
	 * @return array
	 */
	public function parseId(string $id, $transform = false): array;
}
