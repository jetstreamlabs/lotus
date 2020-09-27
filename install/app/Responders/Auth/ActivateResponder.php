<?php

namespace App\Responders\Auth;

use Serenity\Lotus\Core\Responder;

class ActivateResponder extends Responder
{
    /**
     * Build up a response and return it to our action.
     *
     * @return \Illuminate\View\Factory
     */
    public function send()
    {
        $payload = $this->payload->getData();

        return redirect(route($payload['route']));
    }
}
