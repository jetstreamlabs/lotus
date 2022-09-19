<?php

/*
 * Lotus Package for ADR, Inertia, Snowflake support in Laravel ^8.*
 *
 * Copyright (c) Jetstream Labs, LLC. - All Rights Reserved.
 * Licensed under the MIT License (MIT) - https://opensource.org/licenses/MIT
 * Maintained by secondmanveran - Queen Creek, AZ USA
 */

namespace Jetlabs\Lotus\Snowflake;

use Exception;

class Driver implements DriverInterface
{
	const MAX_TIMESTAMP_LENGTH = 41;
	const MAX_DATACENTER_LENGTH = 5;
	const MAX_WORKID_LENGTH = 5;
	const MAX_SEQUENCE_LENGTH = 12;
	const MAX_FIRST_LENGTH = 1;

	/**
	 * The data center id.
	 *
	 * @var int
	 */
	protected ?int $datacenter;

	/**
	 * The worker id.
	 *
	 * @var int
	 */
	protected ?int $workerid;

	/**
	 * The Sequence Resolver instance.
	 *
	 * @var ResolverInterface|null
	 */
	protected ResolverInterface $sequence;

	/**
	 * The start timestamp.
	 *
	 * @var int
	 */
	protected int $startTime;

	/**
	 * Default sequence resolver.
	 *
	 * @var ResolverInterface|null
	 */
	protected ResolverInterface $defaultSequenceResolver;

	/**
	 * Build Snowflake Instance.
	 *
	 * @param  int  $datacenter
	 * @param  int  $workerid
	 */
	public function __construct(int $datacenter = null, int $workerid = null)
	{
		$maxDataCenter = -1 ^ (-1 << self::MAX_DATACENTER_LENGTH);
		$maxWorkId = -1 ^ (-1 << self::MAX_WORKID_LENGTH);

		// If not set datacenter or workid, we will set a default value to use.
		$this->datacenter = $datacenter > $maxDataCenter || $datacenter < 0 ? mt_rand(0, 31) : $datacenter;
		$this->workerid = $workerid > $maxWorkId || $workerid < 0 ? mt_rand(0, 31) : $workerid;
	}

	/**
	 * Get snowflake id.
	 *
	 * @return string
	 */
	public function id(): string
	{
		$currentTime = $this->getCurrentMicrotime();
		while (($sequence = $this->callResolver($currentTime)) > (-1 ^ (-1 << self::MAX_SEQUENCE_LENGTH))) {
			usleep(1);
			$currentTime = $this->getCurrentMicrotime();
		}

		$workerLeftMoveLength = self::MAX_SEQUENCE_LENGTH;
		$datacenterLeftMoveLength = self::MAX_WORKID_LENGTH + $workerLeftMoveLength;
		$timestampLeftMoveLength = self::MAX_DATACENTER_LENGTH + $datacenterLeftMoveLength;

		return (string) ((($currentTime - $this->getStartTimeStamp()) << $timestampLeftMoveLength)
	  | ($this->datacenter << $datacenterLeftMoveLength)
	  | ($this->workerid << $workerLeftMoveLength)
	  | ($sequence));
	}

	/**
	 * Parse snowflake id.
	 *
	 * @param  string  $id
	 * @param  bool  $transform
	 * @return array
	 */
	public function parseId(string $id, $transform = false): array
	{
		$id = decbin($id);

		$data = [
			'timestamp'  => substr($id, 0, -22),
			'sequence'   => substr($id, -12),
			'workerid'   => substr($id, -17, 5),
			'datacenter' => substr($id, -22, 5),
		];

		return $transform ? array_map(function ($value) {
			return bindec($value);
		}, $data) : $data;
	}

	/**
	 * Get current microtime timestamp.
	 *
	 * @return int
	 */
	public function getCurrentMicrotime(): int
	{
		return floor(microtime(true) * 1000) | 0;
	}

	/**
	 * Set start time (milliseconds).
	 *
	 * @param  int  $startTime
	 * @return Driver
	 */
	public function setStartTimeStamp(int $startTime): Driver
	{
		$missTime = $this->getCurrentMicrotime() - $startTime;

		if ($missTime < 0) {
			throw new Exception('The start time cannot be greater than the current time');
		}

		$maxTimeDiff = -1 ^ (-1 << self::MAX_TIMESTAMP_LENGTH);

		if ($missTime > $maxTimeDiff) {
			throw new Exception(sprintf('The current microtime - starttime is not allowed to exceed -1 ^ (-1 << %d), You can reset the start time to fix this', self::MAX_TIMESTAMP_LENGTH));
		}

		$this->startTime = $startTime;

		return $this;
	}

	/**
	 * Get start timestamp (millisecond), If not set default to 2020-06-06 06:06:06.
	 *
	 * @return int
	 */
	public function getStartTimeStamp(): int
	{
		if ($this->startTime > 0) {
			return $this->startTime;
		}

		// We set a default start time if not set.
		$defaultTime = '2020-06-06 06:06:06';

		return strtotime($defaultTime) * 1000;
	}

	/**
	 * Set Sequence Resolver.
	 *
	 * @param  ResolverInterface|callable  $sequence
	 * @return Driver
	 */
	public function setSequenceResolver($sequence): Driver
	{
		$this->sequence = $sequence;

		return $this;
	}

	/**
	 * Get Sequence Resolver.
	 *
	 * @return ResolverInterface|callable|null
	 */
	public function getSequenceResolver()
	{
		return $this->sequence;
	}

	/**
	 * Get Default Sequence Resolver.
	 *
	 * @return ResolverInterface
	 */
	public function getDefaultSequenceResolver(): ResolverInterface
	{
		return $this->defaultSequenceResolver
	  ?: $this->defaultSequenceResolver = new RandomResolver();
	}

	/**
	 * Call resolver.
	 *
	 * @param  callable|ResolverInterface  $resolver
	 * @param  int  $maxSequence
	 * @return int
	 */
	protected function callResolver($currentTime): int
	{
		$resolver = $this->getSequenceResolver();

		if (is_callable($resolver)) {
			return $resolver($currentTime);
		}

		return is_null($resolver) || ! ($resolver instanceof ResolverInterface)
	  ? $this->getDefaultSequenceResolver()->sequence($currentTime)
	  : $resolver->sequence($currentTime);
	}
}
