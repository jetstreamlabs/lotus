<?php

/*
 * Lotus Package for ADR, Inertia, Snowflake support in Laravel ^8.*
 *
 * Copyright (c) Jetstream Labs, LLC. - All Rights Reserved.
 * Licensed under the MIT License (MIT) - https://opensource.org/licenses/MIT
 * Maintained by secondmanveran - Queen Creek, AZ USA
 */

namespace Jetlabs\Lotus\Core;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Jetlabs\Lotus\Contracts\FilterInterface;

abstract class Filter implements FilterInterface
{
	/**
	 * Our local request property.
	 *
	 * @var \Illuminate\Http\Request
	 */
	protected Request $request;

	/**
	 * Create a new instance of the class.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 */
	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	/**
	 * Abstract get query class required by filter classes.
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder  $query
	 * @return void
	 */
	abstract public function getQuery(Builder $query);

	/**
	 * Filter the query by soft deletes.
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder  $query
	 * @return void
	 */
	protected function filterByTrashed(Builder $query)
	{
		$query->when($this->request->filled('trashed'), function ($query) {
			if ($this->request->input('trashed') === 'with') {
				$query->withTrashed();
			}

			if ($this->request->input('trashed') === 'only') {
				$query->onlyTrashed();
			}
		});
	}
}
