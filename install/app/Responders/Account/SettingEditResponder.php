<?php

namespace App\Responders\Account;

use Serenity\Lotus\Core\Responder;

class SettingEditResponder extends Responder
{
    /**
     * Build up a response and return it to our action.
     *
     * @return \Illuminate\View\Factory
     */
    public function send()
    {
        $user = $this->payload->getData();

        return $this->view->make('account.settings-edit', compact('user'));
    }
}
