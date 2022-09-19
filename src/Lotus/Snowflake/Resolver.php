<?php

/*
 * Lotus Package for ADR, Inertia, Snowflake support in Laravel ^8.*
 *
 * Copyright (c) Jetstream Labs, LLC. - All Rights Reserved.
 * Licensed under the MIT License (MIT) - https://opensource.org/licenses/MIT
 * Maintained by secondmanveran - Queen Creek, AZ USA
 */

namespace Jetlabs\Lotus\Snowflake;

use Illuminate\Contracts\Cache\Repository;

class Resolver implements ResolverInterface
{
	/**
	 * The laravel cache instance.
	 *
	 * @var \Illuminate\Contracts\Cache\Repository
	 */
	protected Repository $cache;

	/**
	 * Init resolve instance, must connectioned.
	 */
	public function __construct(Repository $cache)
	{
		$this->cache = $cache;
	}

	/**
	 * Increment the sequence.
	 *
	 * @param  int  $currentTime
	 * @return int
	 */
	public function sequence(int $currentTime): int
	{
		$key = $currentTime;

		if ($this->cache->add($key, 1, 1)) {
			return 0;
		}

		return $this->cache->increment($key, 1);
	}
}
