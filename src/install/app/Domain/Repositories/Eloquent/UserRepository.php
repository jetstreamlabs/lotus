<?php

namespace App\Domain\Repositories\Eloquent;

use App\Domain\Entities\User;
use Serenity\Lotus\Core\Repository;
use App\Domain\Repositories\Contracts\UserRepositoryInterface;

class UserRepository extends Repository implements UserRepositoryInterface
{
    /**
     * Set the repository entity.
     *
     * @return \App\Domain\Entities\User
     */
    public function entity()
    {
        return User::class;
    }

    /**
     * Persist the user in the db.
     *
     * @param  array
     * @return \App\Domain\Entities\User
     */
    public function create(array $properties)
    {
        $properties['password'] = bcrypt($properties['password']);

        return $this->entity->create($properties);
    }
}
