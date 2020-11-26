<?php

namespace App\Domain\Services\Account;

use Serenity\Lotus\Core\Service;
use App\Domain\Entities\User;
use App\Domain\Repositories\Contracts\UserRepositoryContract;
use App\Domain\Payloads\{
    EntityPayload,
    EmptyPayload,
    MessagePayload
};

class SettingService extends Service
{
    /**
     * Instance of Repository property.
     *
     * @var \App\Domain\Repositories\Contracts\UserRepositoryContract
     */
    protected $users;

    /**
     * Instantiate the class.
     *
     * @param \App\Domain\Repositories\Contracts\UserRepository
     */
    public function __construct(UserRepositoryContract $users)
    {
        $this->users = $users;
    }

    /**
     * Handle our request from the action.
     *
     * @param  \App\Domain\Entities\User
     * @return \Serenity\Lotus\Contracts\PayloadContract
     */
    public function handle(User $user)
    {
        // nothing to do here other than build a payload
        return new EntityPayload($user);
    }

    /**
     * Update our user settings.
     *
     * @param  int   $id
     * @param  array $request
     * @return \Serenity\Lotus\Contracts\PayloadContract
     */
    public function update($id, $request)
    {
        if ($this->users->update($id, $request)) {
            return new MessagePayload([
                'message' => 'Your settings have been updated successfully.',
                'level'   => 'success',
                'route'   => 'dashboard'
            ]);
        }

        return new EmptyPayload();
    }
}
