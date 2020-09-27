<?php

namespace App\Domain\Services\Auth;

use Serenity\Lotus\Core\Service;
use App\Domain\Payloads\EmptyPayload;

class LogoutService extends Service
{
    /**
     * Handle incoming data from your action.
     *
     * @return mixed
     */
    public function handle($request)
    {
        \Auth::guard()->logout();

        $request->session()->invalidate();

        return new EmptyPayload([
            'route' => 'login.show',
        ]);
    }
}
