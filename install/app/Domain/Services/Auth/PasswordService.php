<?php

namespace App\Domain\Services\Auth;

use Illuminate\Http\Request;
use Serenity\Lotus\Core\Service;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class PasswordService extends Service
{
    use SendsPasswordResetEmails;

    /**
     * Handle a reset request for the application.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function handle(Request $request)
    {
        return $this->sendResetLinkEmail($request);
    }
}
