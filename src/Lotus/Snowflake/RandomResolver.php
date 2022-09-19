<?php

/*
 * Lotus Package for ADR, Inertia, Snowflake support in Laravel ^8.*
 *
 * Copyright (c) Jetstream Labs, LLC. - All Rights Reserved.
 * Licensed under the MIT License (MIT) - https://opensource.org/licenses/MIT
 * Maintained by secondmanveran - Queen Creek, AZ USA
 */

namespace Jetlabs\Lotus\Snowflake;

class RandomResolver implements ResolverInterface
{
	/**
	 * The last timestamp.
	 *
	 * @var int|null
	 */
	protected ?int $lastTimeStamp = -1;

	/**
	 * The sequence.
	 *
	 * @var int
	 */
	protected int $sequence = 0;

	/**
	 * Increment the sequence.
	 *
	 * @param  int  $currentTime
	 * @return int
	 */
	public function sequence(int $currentTime): int
	{
		if ($this->lastTimeStamp === $currentTime) {
			$this->sequence++;
			$this->lastTimeStamp = $currentTime;

			return $this->sequence;
		}

		$this->sequence = 0;
		$this->lastTimeStamp = $currentTime;

		return 0;
	}
}
