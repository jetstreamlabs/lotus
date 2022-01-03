<?php

/*
 * Lotus Package for ADR, Inertia, Snowflake support in Laravel ^8.*
 *
 * Copyright (c) Jetstream Labs, LLC. - All Rights Reserved.
 * Licensed under the MIT License (MIT) - https://opensource.org/licenses/MIT
 * Maintained by secondmanveran - Queen Creek, AZ USA
 */

namespace Serenity\Lotus\Payloads;

use Serenity\Lotus\Core\Payload;

class InertiaPayload extends Payload
{
	/**
	 * Instantiate the payload class.
	 *
	 * @param array $data
	 */
	public function __construct(array $data = [])
	{
		parent::__construct($data);
	}
}
