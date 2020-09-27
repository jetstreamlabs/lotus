<?php

namespace App\Domain\Concerns;

use Ramsey\Uuid\Uuid;

trait MakesUuids
{
    /**
     * Boot function from Model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Uuid::uuid4()->toString();
        });
    }
}
