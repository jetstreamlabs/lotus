<?php

namespace App\Responders\Auth;

use Serenity\Lotus\Core\Responder;

class LogoutResponder extends Responder
{
    /**
     * Build up a response and return it to our action.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send()
    {
        $data = $this->payload->getData();

        return redirect(route($data['route']));
    }
}
