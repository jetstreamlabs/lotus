<?php

/*
 * Lotus Package for ADR, Inertia, Snowflake support in Laravel ^8.*
 *
 * Copyright (c) Jetstream Labs, LLC. - All Rights Reserved.
 * Licensed under the MIT License (MIT) - https://opensource.org/licenses/MIT
 * Maintained by secondmanveran - Queen Creek, AZ USA
 */

namespace Jetlabs\Lotus\Middleware;

use Closure;
use Illuminate\Http\Request;
use Jetlabs\Lotus\Lotus;
use Symfony\Component\HttpFoundation\Response;

class InertiaMiddleware
{
	/**
	 * The root template that's loaded on the first page visit.
	 *
	 * @var string
	 */
	protected $rootView = 'app';

	/**
	 * Build the version string to pass into ResponseFactory.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return string
	 */
	public function version(Request $request): string
	{
		if (config('app.asset_url')) {
			return md5(config('app.asset_url'));
		}

		if (file_exists($manifest = public_path('mix-manifest.json'))) {
			return md5_file($manifest);
		}
	}

	/**
	 * Defines the props that are shared by default.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function share(Request $request)
	{
		return [
			'errors' => function () use ($request) {
				return $this->resolveValidationErrors($request);
			},
		];
	}

	/**
	 * Sets the root template that's loaded on the first page visit.
	 *
	 * @return string
	 */
	public function rootView(): string
	{
		return $this->rootView;
	}

	/**
	 * Handle the incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  Closure  $next
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function handle(Request $request, Closure $next)
	{
		Lotus::version(function () use ($request) {
			return $this->version($request);
		});

		Lotus::share($this->share($request));

		Lotus::setRootView($this->rootView($request));

		$response = $next($request);
		$response = $this->checkVersion($request, $response);
		$response = $this->changeRedirectCode($request, $response);

		return $response;
	}

	/**
	 * In the event that the assets change, initiate a
	 * client-side location visit to force an update.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Symfony\Component\HttpFoundation\Response  $response
	 * @return \Symfony\Component\HttpFoundation\Response
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
	 * @param  Request  $request
	 * @param  Response  $response
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

	/**
	 * Resolves and prepares validation errors in such
	 * a way that they are easier to use client-side.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return object
	 */
	public function resolveValidationErrors(Request $request)
	{
		if (! $request->session()->has('errors')) {
			return (object) [];
		}

		return (object) collect($request->session()->get('errors')->getBags())->map(function ($bag) {
			return (object) collect($bag->messages())->map(function ($errors) {
				return $errors;
			})->toArray();
		})->pipe(function ($bags) use ($request) {
			if ($bags->has('default') && $request->header('x-inertia-error-bag')) {
				return [
					$request->header('x-inertia-error-bag') => $bags->get('default'),
				];
			} elseif ($bags->has('default')) {
				return $bags->get('default');
			} else {
				return $bags->toArray();
			}
		});
	}
}
