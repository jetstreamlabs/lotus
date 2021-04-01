<?php

namespace App\Domain\Services\Auth;

use Serenity\Lotus\Core\Service;
use Illuminate\Auth\Events\Registered;
use App\Domain\Payloads\MessagePayload;
use App\Domain\Repositories\Contracts\UserRepositoryInterface;

class RegisterService extends Service
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
     * Handle a registration request for the application.
     *
     * @param  array $request
     * @return \Serenity\Lotus\Contracts\PayloadInterface
     */
    public function handle($request)
    {
        event(new Registered($user = $this->create($request)));

        return new MessagePayload([
            'level'   => 'success',
            'message' => 'Please check your email to activate your account.',
            'route'   => 'login.show',
        ]);
    }

    /**
     * Persist a new user in storage.
     *
     * @param  array  $data
     * @return \App\Domain\Entities\User
     */
    protected function create(array $data)
    {
        return $this->users->create([
            'username'  => mb_strtolower($data['username']),
            'name'      => ucwords(mb_strtolower($data['name'])),
            'email'     => mb_strtolower($data['email']),
            'password'  => bcrypt($data['password']),
        ]);
    }
}
