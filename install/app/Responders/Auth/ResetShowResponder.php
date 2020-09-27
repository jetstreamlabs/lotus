<?php

namespace App\Responders\Auth;

use Illuminate\Http\Request;
use Serenity\Lotus\Core\Responder;

class ResetShowResponder extends Responder
{
    /**
     * Build up a response and return it to our action.
     *
     * @return \Illuminate\View\Factory
     */
    public function send(Request $request, $token = null)
    {
        return $this->view->make('auth.passwords.reset')->with([
            'token' => $token,
            'email' => $request->email
        ]);
    }
}
