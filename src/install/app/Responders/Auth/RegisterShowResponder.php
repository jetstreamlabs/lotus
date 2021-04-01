<?php

namespace App\Responders\Auth;

use Serenity\Lotus\Core\Responder;

class RegisterShowResponder extends Responder
{
    /**
     * Build up a response and return it to our action.
     *
     * @return \Illuminate\View\Factory
     */
    public function send()
    {
        return $this->view->make('auth.register');
    }
}
