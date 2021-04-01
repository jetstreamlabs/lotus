<?php

namespace Serenity\Lotus;

use Illuminate\Support\Facades\Facade;
use Serenity\Lotus\Contracts\ResponseFactoryInterface;

class Lotus extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    protected static function getFacadeAccessor()
    {
        return ResponseFactoryInterface::class;
    }
}
