<?php

namespace App\Actions\Auth;

use Serenity\Lotus\Core\Action;
use App\Responders\Auth\RegisterShowResponder;

class RegisterShowAction extends Action
{
    /**
     * @var \Serenity\Lotus\Contracts\ResponderContract
     */
    protected $responder;

    /**
     * Instantiate the class.
     *
     * @param \App\Responders\Auth\RegisterShowResponder
     */
    public function __construct(RegisterShowResponder $responder)
    {
        $this->responder = $responder;
    }

    /**
     * Invoke our action, handle domain, respond.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        return $this->responder->send();
    }
}
