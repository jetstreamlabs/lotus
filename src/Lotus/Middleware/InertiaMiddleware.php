<?php

/*
 * Lotus Package for ADR, Inertia, Snowflake support in Laravel ^8.*
 *
 * Copyright (c) Jetstream Labs, LLC. - All Rights Reserved.
 * Licensed under the MIT License (MIT) - https://opensource.org/licenses/MIT
 * Maintained by secondmanveran - Queen Creek, AZ USA
 */

namespace Serenity\Lotus\Middleware;

use Closure;
use Illuminate\Http\Request;
use Serenity\Lotus\Lotus;
use Symfony\Component\HttpFoundation\Response;

class InertiaMiddleware
{
	/**
	 * Handle the incoming request.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param Closure                  $next
	 *
	 * @return Response
	 */
	public function handle(Request $request, Closure $next)
	{
		$response = $next($request);
		$response = $this->checkVersion($request, $response);
		$response = $this->changeRedirectCode($request, $response);

		return $response;
	}

	/**
	 * In the event that the assets change, initiate a
	 * client-side location visit to force an update.
	 *
	 * @param Request  $request
	 * @param Response $response
	 *
	 * @return Response
	 */
	public function checkVersion(Request $request, Response $response)
	{
		if (
			$request->header('X-Inertia') &&
			$request->method() === 'GET' &&
			$request->header('X-Inertia-Version', '') !== Lotus::getVersion()
		) {
			if ($request->hasSession()) {
				$request->session()->reflash();
			}

			return Lotus::location($request->fullUrl());
		}

		return $response;
	}

	/**
	 * Changes the status code during redirects, ensuring they are made as
	 * GET requests, preventing "MethodNotAllowedHttpException" errors.
	 *
	 * @param Request  $request
	 * @param Response $response
	 *
	 * @return Response
	 */
	public function changeRedirectCode(Request $request, Response $response)
	{
		if (
			$request->header('X-Inertia') &&
			$response->getStatusCode() === 302 &&
			in_array($request->method(), ['PUT', 'PATCH', 'DELETE'])
		) {
			$response->setStatusCode(303);
		}

		return $response;
	}
}
