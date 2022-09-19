<?php

/*
 * Lotus Package for ADR, Inertia, Snowflake support in Laravel ^8.*
 *
 * Copyright (c) Jetstream Labs, LLC. - All Rights Reserved.
 * Licensed under the MIT License (MIT) - https://opensource.org/licenses/MIT
 * Maintained by secondmanveran - Queen Creek, AZ USA
 */

namespace Jetlabs\Lotus\Concerns;

use Illuminate\Database\Eloquent\Model;

trait HasSnowflakePrimary
{
	public static function bootHasSnowflakePrimary()
	{
		static::saving(function (Model $model) {
			if (is_null($model->getKey())) {
				$model->setIncrementing(false);

				$model->setAttribute(
		  $model->getKeyName(), app('snowflake')->id()
		);
			}
		});
	}
}
