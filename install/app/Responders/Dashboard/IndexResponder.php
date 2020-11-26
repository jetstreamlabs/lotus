<?php

namespace App\Responders\Dashboard;

use Serenity\Lotus\Core\Responder;

class IndexResponder extends Responder
{
    /**
     * Build up a response and return it to our action.
     *
     * @return \Illuminate\View\Factory
     */
    public function send()
    {
        return $this->view->make('dashboard');
    }
}
