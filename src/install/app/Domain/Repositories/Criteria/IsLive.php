<?php

namespace App\Domain\Repositories\Criteria;

use Serenity\Lotus\Contracts\CriterionInterface;

class IsLive implements CriterionInterface
{
    /**
     * Apply the requirements to the entity.
     *
     * @param  object $entity
     * @return object
     */
    public function apply($entity)
    {
        return $entity->live();
    }
}
