<?php

/*
 * Lotus Package for ADR, Inertia, Snowflake support in Laravel ^8.*
 *
 * Copyright (c) Jetstream Labs, LLC. - All Rights Reserved.
 * Licensed under the MIT License (MIT) - https://opensource.org/licenses/MIT
 * Maintained by secondmanveran - Queen Creek, AZ USA
 */

namespace Jetlabs\Lotus\Core;

use Jetlabs\Lotus\Snowflake\Driver;
use Jetlabs\Lotus\Snowflake\DriverInterface;
use Jetlabs\Lotus\Snowflake\Resolver;
use Jetlabs\Lotus\Snowflake\ResolverInterface;

class Snowflake
{
	/**
	 * Local Driver property.
	 *
	 * @var \Jetlabs\Lotus\Snowflake\Driver
	 */
	protected Driver $driver;

	/**
	 * Local Resolver property.
	 *
	 * @var \Jetlabs\Lotus\Snowflake\Resolver
	 */
	protected Resolver $resolver;

	/**
	 * Create a new instance of the class.
	 *
	 * @param  \Jetlabs\Lotus\Snowflake\DriverInterface  $driver
	 * @param  \Jetlabs\Lotus\Snowflake\ResolverInterface  $resolver
	 */
	public function __construct(DriverInterface $driver, ResolverInterface $resolver)
	{
		$this->driver = $driver;
		$this->resolver = $resolver;

		$this->make();
	}

	/**
	 * Build and return a new configured Snowflake driver.
	 *
	 * @return \Jetlabs\Lotus\Snowflake\DriverInterface
	 */
	public function make(): DriverInterface
	{
		$instance = $this->driver->setStartTimeStamp(time() * 1000)
	  ->setSequenceResolver($this->resolver);

		return $instance;
	}

	/**
	 * Return a snowflake id from the driver.
	 *
	 * @return int
	 */
	public function id(): int
	{
		return $this->driver->id();
	}
}
