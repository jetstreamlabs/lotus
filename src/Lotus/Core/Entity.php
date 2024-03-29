<?php

/*
 * Lotus Package for ADR, Inertia, Snowflake support in Laravel ^8.*
 *
 * Copyright (c) Jetstream Labs, LLC. - All Rights Reserved.
 * Licensed under the MIT License (MIT) - https://opensource.org/licenses/MIT
 * Maintained by secondmanveran - Queen Creek, AZ USA
 */

namespace Jetlabs\Lotus\Core;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jetlabs\Lotus\Concerns\HasSnowflakePrimary;

abstract class Entity extends Model
{
	use HasSnowflakePrimary;

	/**
	 * The primary key for the model.
	 *
	 * @var string
	 */
	protected $primaryKey = 'id';

	/**
	 * Indicates if the IDs are auto-incrementing.
	 *
	 * @var bool
	 */
	public $incrementing = false;

	/**
	 * The number of models to return for pagination.
	 *
	 * @var int
	 */
	protected $perPage = 10;

	/**
	 * Retrieve the model for a bound value.
	 *
	 * @param  mixed  $value
	 * @param  string|null  $field
	 * @return \Illuminate\Database\Eloquent\Model|null
	 */
	public function resolveRouteBinding($value, $field = null)
	{
		return in_array(SoftDeletes::class, class_uses($this))
			? $this->where($this->getRouteKeyName(), $value)->withTrashed()->first()
			: parent::resolveRouteBinding($value);
	}

	/**
	 * Return self to ensure proper error handling.
	 *
	 * @return self
	 */
	public function getEntity()
	{
		return $this;
	}
}
