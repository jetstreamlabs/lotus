<?php

namespace Serenity\Lotus\Concerns;

use Godruoyi\Snowflake\Snowflake;

trait HasSnowflakePrimary
{
	public static function bootHasSnowflakePrimary()
	{
		static::saving(function ($model) {
			if (is_null($model->getKey())) {
				$model->setIncrementing(false);
				$keyName	= $model->getKeyName();
				$id		 = app(Snowflake::class)->id();
				$model->setAttribute($keyName, $id);
			}
		});
	}
}
