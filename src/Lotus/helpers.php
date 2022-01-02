<?php

/*
 * Lotus Package for ADR, Inertia, Snowflake support in Laravel ^8.*
 *
 * Copyright (c) Jetstream Labs, LLC. - All Rights Reserved.
 * Licensed under the MIT License (MIT) - https://opensource.org/licenses/MIT
 * Maintained by secondmanveran - Queen Creek, AZ USA
 */

if (!function_exists('bcs')) {
	/**
	 * Return the breadcrumb instance from the container
	 * or push new crumbs to instance.
	 *
	 * @param string|array $text
	 * @param string       $route
	 *
	 * @return \App\Services\Breadcrumbs|void
	 */
	function bcs($text = null, $route = null)
	{

		// If nothing is passed return the object.
		if (is_null($text) && is_null($route)) {
			return app('breadcrumb');
		}

		// Array passed, parse it and return.
		if (is_array($text)) {
			foreach ($text as $key => $value) {
				if (is_null($value)) {
					app('breadcrumb')->add($key);
				} else {
					app('breadcrumb')->add($key, $value);
				}
			}

			return;
		}

		// No route
		if (is_null($route)) {
			return app('breadcrumb')->add($text);
		}

		// Normal single add
		app('breadcrumb')->add($text, $route);
	}
}
