<?php

namespace App\Actions\Auth;

use Serenity\Lotus\Core\Action;
use App\Responders\Auth\PasswordShowResponder;

class PasswordShowAction extends Action
{
    /**
     * @var \Serenity\Lotus\Contracts\ResponderInterface
     */
    protected $responder;

    /**
     * Instantiate the class.
     *
     * @param \App\Responders\Auth\PasswordShowResponder
     */
    public function __construct(PasswordShowResponder $responder)
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
