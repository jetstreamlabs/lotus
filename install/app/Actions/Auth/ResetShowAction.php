<?php

namespace App\Actions\Auth;

use Serenity\Lotus\Core\Action;
use Illuminate\Http\Request;
use App\Responders\Auth\ResetResponder;
use App\Domain\Services\Auth\ResetService;

class ResetShowAction extends Action
{
    /**
     * @var \Serenity\Lotus\Contracts\ResponderContract
     */
    protected $responder;

    /**
     * @var \Serenity\Lotus\Contracts\ServiceContract
     */
    protected $service;

    /**
     * Instantiate the class.
     *
     * @param \App\Responders\Auth\ResetResponder
     * @param \App\Domain\Services\Auth\ResetService
     */
    public function __construct(ResetResponder $responder, ResetService $service)
    {
        $this->responder = $responder;
        $this->service   = $service;
    }

    /**
     * Invoke our action, handle domain, respond.
     *
     * @param  \Illuminate\Http\Request
     * @param  string  $token
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $token = null)
    {
        return $this->responder->send($request, $token);
    }
}
