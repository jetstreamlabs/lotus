<?php

/*
 * Lotus Package for ADR, Inertia, Snowflake support in Laravel ^8.*
 * --------------------------------------------------------------------------
 * Copyright (c) Jetstream Labs, LLC. - All Rights Reserved.
 * Licensed under the MIT License (MIT) - https://opensource.org/licenses/MIT
 * Maintained by secondmanveran - Queen Creek, AZ USA
 */

namespace Serenity\Lotus\Core;

use Serenity\Lotus\Contracts\PayloadInterface;
use Serenity\Lotus\Contracts\ResponderInterface;

abstract class Responder implements ResponderInterface
{
	/**
	 * Local payload property.
	 *
	 * @var \Serenity\Lotus\Contracts\PayloadInterface
	 */
	protected $payload;

	/**
	 * Does the given action require a payload?
	 *
	 * @var bool
	 */
	protected $expectsPayload = true;

	/**
	 * Build up the HTTP response.
	 *
	 * @param  \Serenity\Lotus\Contracts\PayloadInterface
	 *
	 * @return \Serenity\Lotus\Contracts\ResponderInterface
	 */
	public function make(PayloadInterface $payload): ResponderInterface
	{
		$this->payload = $payload;

		return $this;
	}

	/**
	 * Let the responder know if the action needs a payload.
	 *
	 * @param bool $expects
	 *
	 * @return \Serenity\Lotus\Contracts\ResponderInterface
	 */
	public function expectsPayload(bool $expects = true): ResponderInterface
	{
		$this->expectsPayload = $expects;

		return $this;
	}
}
