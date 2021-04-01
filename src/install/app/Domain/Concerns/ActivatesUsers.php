<?php

namespace App\Domain\Concerns;

use Illuminate\Http\Request;

trait ActivatesUsers
{
    /**
     * Override of AuthenticatesUsers credentials method.
     *
     * @param  Request $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        $login = $request->login;
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        return [
            $field             => $login,
            'password'         => $request->password,
            'activation_token' => null
        ];
    }
}
