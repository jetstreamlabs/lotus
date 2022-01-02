<?php

/*
 * Lotus Package for ADR, Inertia, Snowflake support in Laravel ^8.*
 * --------------------------------------------------------------------------
 * Copyright (c) Jetstream Labs, LLC. - All Rights Reserved.
 * Licensed under the MIT License (MIT) - https://opensource.org/licenses/MIT
 * Maintained by secondmanveran - Queen Creek, AZ USA
 */

namespace Serenity\Lotus\Concerns;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

trait SelfResolves
{
	/**
	 * Resolves model regardless of given identifier.
	 *
	 * @param $model
	 * @param bool $withTrashed
	 *
	 * @throws \Exception
	 *
	 * @return mixed
	 */
	public static function resolveSelf($model, $withTrashed = false)
	{
		$className = get_called_class();

		if (is_null($model)) {
			return null;
		}

		if (!$model instanceof $className) {
			if (is_numeric($model)) {
				try {
					$model = $className::when($withTrashed, function ($query) {
						return $query->withTrashed();
					})->findOrFail($model);
				} catch (ModelNotFoundException $e) {
					throw new Exception($className.' not found with the given ID.');
				}
			} else {
				try {
					$model = $className::when($withTrashed, function ($query) {
						return $query->withTrashed();
					})->where('slug', $model)->firstOrFail();
				} catch (ModelNotFoundException $e) {
					throw new Exception($className.' not found with the given slug.');
				}
			}
		}

		return $model;
	}
}
