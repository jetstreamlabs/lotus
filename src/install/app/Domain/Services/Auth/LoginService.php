<?php

namespace App\Domain\Services\Auth;

use Serenity\Lotus\Core\Service;
use Illuminate\Http\Request;
use App\Domain\Concerns\ActivatesUsers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginService extends Service
{
    use AuthenticatesUsers;
    use ActivatesUsers {
        ActivatesUsers::credentials insteadof AuthenticatesUsers;
    }

    /**
     * Handle the login request.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function handle(Request $request)
    {
        return $this->login($request);
    }

    /**
     * Get the login username to be used by the service.
     *
     * @return string
     */
    public function username()
    {
        return 'login';
    }

    /**
     * Route to redirect authenticated users to.
     *
     * @return string
     */
    protected function redirectTo()
    {
        return route('dashboard');
    }
}
