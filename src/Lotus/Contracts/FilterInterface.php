<?php

namespace Serenity\Lotus\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface FilterInterface
{
    /**
     * Get the give query scopes.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return void
     */
    public function getQuery(Builder $query);
}
