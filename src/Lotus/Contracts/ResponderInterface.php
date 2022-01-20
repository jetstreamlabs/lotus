<?php

/*
 * Lotus Package for ADR, Inertia, Snowflake support in Laravel ^8.*
 *
 * Copyright (c) Jetstream Labs, LLC. - All Rights Reserved.
 * Licensed under the MIT License (MIT) - https://opensource.org/licenses/MIT
 * Maintained by secondmanveran - Queen Creek, AZ USA
 */

namespace Jetlabs\Lotus\Contracts;

interface ResponderInterface
{
	/**
	 * Build up the HTTP response.
	 *
	 * @param  \Jetlabs\Lotus\Contracts\PayloadInterface
	 * @return \Jetlabs\Lotus\Contracts\ResponderInterface
	 */
	public function make(PayloadInterface $payload): ResponderInterface;

	/**
	 * Let the responder know if the action needs a payload.
	 *
	 * @param  bool  $expects
	 * @return \Jetlabs\Lotus\Contracts\ResponderInterface
	 */
	public function expectsPayload(bool $expects = true): ResponderInterface;

	/**
	 * Send a normal page response.
	 *
	 * @return mixed
	 */
	public function send();

	/**
	 * Send a proper redirect response.
	 *
	 * @return mixed
	 */
	public function replace();
}
