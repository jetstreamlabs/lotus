<?php

namespace Serenity\Lotus\Contracts;

interface CriterionInterface
{
	/**
	 * Apply the requirements to the entity.
	 *
	 * @param  object $entity
	 */
	public function apply($entity);
}
