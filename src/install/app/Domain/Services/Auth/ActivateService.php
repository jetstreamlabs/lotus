<?php

namespace App\Domain\Services\Auth;

use Serenity\Lotus\Core\Service;
use App\Domain\Payloads\MessagePayload;
use App\Domain\Repositories\Contracts\UserRepositoryInterface;

class ActivateService extends Service
{
    /**
     * @var \App\Domain\Repositories\Contracts\UserRepositoryInterface
     */
    protected $users;

    /**
     * Instantiate the class.
     *
     * @param \App\Domain\Repositories\Contracts\UserRepositoryInterface
     */
    public function __construct(UserRepositoryInterface $users)
    {
        $this->users = $users;
    }

    /**
     * Handle incoming data from your action.
     *
     * @return mixed
     */
    public function handle($token)
    {
        if ($user = $this->users->findWhereFirst('activation_token', $token)) {

            $user->activate();

            \Auth::guard()->login($user);

            return new MessagePayload([
                'level'   => 'success',
                'message' => 'Thank you for activating your account.',
                'route'   => 'dashboard'
            ]);
        }

        return new MessagePayload([
            'level'   => 'error',
            'message' => 'Your account has either already been activated, or there is a typo in your activation token.',
            'route'   => 'login.show',
        ]);
    }
}
