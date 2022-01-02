<?php

/*
 * Lotus Package for ADR, Inertia, Snowflake support in Laravel ^8.*
 * --------------------------------------------------------------------------
 * Copyright (c) Jetstream Labs, LLC. - All Rights Reserved.
 * Licensed under the MIT License (MIT) - https://opensource.org/licenses/MIT
 * Maintained by secondmanveran - Queen Creek, AZ USA
 */

namespace Serenity\Lotus\Core;

class Breadcrumbs
{
	/**
	 * @var array
	 */
	protected $breadcrumbs = [];

	/**
	 * Add a new breadcrumb to the stack.
	 *
	 * @param string $text
	 * @param string $route
	 */
	public function add($text, $route = null)
	{
		$this->breadcrumbs[] = [
			'text'  => $text,
			'route' => !is_null($route) ? $route : 'last',
		];

		return $this;
	}

	/**
	 * Return the breadcrumbs array.
	 *
	 * @return array
	 */
	public function render()
	{
		return $this->breadcrumbs;
	}
}
