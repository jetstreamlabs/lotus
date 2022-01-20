<?php

/*
 * Lotus Package for ADR, Inertia, Snowflake support in Laravel ^8.*
 *
 * Copyright (c) Jetstream Labs, LLC. - All Rights Reserved.
 * Licensed under the MIT License (MIT) - https://opensource.org/licenses/MIT
 * Maintained by secondmanveran - Queen Creek, AZ USA
 */

namespace Jetlabs\Lotus\Core;

class Options
{
	/**
	 * The middleware options.
	 *
	 * @var array
	 */
	protected $options;

	/**
	 * Create a new middleware option instance.
	 *
	 * @param  array  $options
	 * @return void
	 */
	public function __construct(array &$options)
	{
		$this->options = &$options;
	}

	/**
	 * Set the controller methods the middleware should apply to.
	 *
	 * @param  array|string|dynamic  $methods
	 * @return $this
	 */
	public function only($methods)
	{
		$this->options['only'] = is_array($methods) ? $methods : func_get_args();

		return $this;
	}

	/**
	 * Set the controller methods the middleware should exclude.
	 *
	 * @param  array|string|dynamic  $methods
	 * @return $this
	 */
	public function except($methods)
	{
		$this->options['except'] = is_array($methods) ? $methods : func_get_args();

		return $this;
	}
}
