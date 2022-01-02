<?php

/*
 * Lotus Package for ADR, Inertia, Snowflake support in Laravel ^8.*
 *
 * Copyright (c) Jetstream Labs, LLC. - All Rights Reserved.
 * Licensed under the MIT License (MIT) - https://opensource.org/licenses/MIT
 * Maintained by secondmanveran - Queen Creek, AZ USA
 */

namespace Serenity\Lotus\Contracts;

interface ActionInterface
{
	/**
	 * Register middleware on the action.
	 *
	 * @param array|string|\Closure $middleware
	 * @param array                 $options
	 *
	 * @return \Serenity\Lotus\Core\Options
	 */
	public function middleware($middleware, array $options = []);

	/**
	 * Get the middleware assigned to the action.
	 *
	 * @return array
	 */
	public function getMiddleware();

	/**
	 * Execute an action on the controller.
	 *
	 * @param string $method
	 * @param array  $parameters
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function callAction($method, $parameters);

	/**
	 * Handle calls to missing methods on the action.
	 *
	 * @param string $method
	 * @param array  $parameters
	 *
	 * @throws \BadMethodCallException
	 *
	 * @return mixed
	 */
	public function __call($method, $parameters);
}
