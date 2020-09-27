<?php

namespace App\Actions\Dashboard;

use Serenity\Lotus\Core\Action;
use Illuminate\Http\Request;
use App\Responders\Dashboard\IndexResponder;


class IndexAction extends Action
{
    /**
     * Instance of the Responder property.
     *
     * @var \App\Responders\Dashboard\IndexResponder
     */
    protected $responder;

    /**
     * Create a new action instance.
     *
     * @param \App\Responders\Dashboard\IndexResponder
     */
    public function __construct(IndexResponder $responder)
    {
        $this->responder = $responder;
    }

    /**
     * Invoke our action, handle domain, respond.
     *
     * @return \App\Responders\Dashboard\IndexResponder
     */
    public function __invoke()
    {
        return $this->responder->send();
    }
}
