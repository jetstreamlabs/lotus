<?php

namespace App\Domain\Services\Auth;

use Serenity\Lotus\Core\Service;
use Illuminate\Http\Request;
use App\Domain\Concerns\PasswordResets;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetService extends Service
{
    use ResetsPasswords;
    use PasswordResets {
        PasswordResets::sendResetResponse insteadof ResetsPassword;
        PasswordResets::sendResetFailedResponse insteadof ResetsPasswords;
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function handle(Request $request)
    {
        return $this->reset($request);
    }

    public function show()
    {

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
