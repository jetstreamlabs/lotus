<?php

namespace App\Domain\Repositories\Criteria;

use Serenity\Lotus\Contracts\CriterionContract;

class EagerLoad implements CriterionContract
{
    /**
     * Relationships array.
     *
     * @var array
     */
    protected $relations;

    /**
     * Create an instance of the class.
     *
     * @param array $relations
     */
    public function __construct(array $relations)
    {
        $this->relations = $relations;
    }

    /**
     * Apply the requirements to the entity.
     *
     * @param  object $entity
     * @return object
     */
    public function apply($entity)
    {
        return $entity->with($this->relations);
    }
}
