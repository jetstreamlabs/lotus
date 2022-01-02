<?php

namespace Serenity\Lotus;

use Illuminate\Support\Facades\Facade;
use Serenity\Lotus\Contracts\ResponseFactoryInterface;

class Lotus extends Facade
{
	/**
	 * Get the registered name of the component.
	 *
	 * @throws \RuntimeException
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		return ResponseFactoryInterface::class;
	}
}
