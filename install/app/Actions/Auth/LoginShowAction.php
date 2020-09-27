<?php

namespace App\Actions\Auth;

use Serenity\Lotus\Core\Action;
use App\Responders\Auth\LoginShowResponder;

class LoginShowAction extends Action
{
    /**
     * @var \Serenity\Lotus\Contracts\ResponderContract
     */
    protected $responder;

    /**
     * Instantiate the class.
     *
     * @param \App\Responders\Auth\LoginShowResponder
     */
    public function __construct(LoginShowResponder $responder)
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
