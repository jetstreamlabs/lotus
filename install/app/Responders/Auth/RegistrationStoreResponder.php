<?php

namespace App\Responders\Auth;

use Serenity\Lotus\Core\Responder;

class RegistrationStoreResponder extends Responder
{
    /**
     * Build up a response and return it to our action.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send()
    {
        $payload = $this->payload->getData();

        return redirect(route($payload['route']));
    }
}
