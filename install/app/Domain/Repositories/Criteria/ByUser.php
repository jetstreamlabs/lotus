<?php

namespace App\Domain\Repositories\Criteria;

use Serenity\Lotus\Contracts\CriterionContract;

class ByUser implements CriterionContract
{
    /**
     * Id of the given user.
     *
     * @var integer
     */
    protected $user;

    /**
     * Instantiate the class.
     *
     * @param integer $id
     */
    public function __construct($id)
    {
        $this->user = $id;
    }

    /**
     * Apply the requirements to the entity.
     *
     * @param  object $entity
     * @return object
     */
    public function apply($entity)
    {
        return $entity->where('user_id', $this->user);
    }
}
