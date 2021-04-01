<?php

namespace App\Actions\Auth;

use Illuminate\Http\Request;
use Serenity\Lotus\Core\Action;
use App\Responders\Auth\LogoutResponder;
use App\Domain\Services\Auth\LogoutService;

class LogoutAction extends Action
{
    /**
     * @var \Serenity\Lotus\Contracts\ServiceInterface
     */
    protected $service;

    /**
     * @var \Serenity\Lotus\Contracts\ResponderInterface
     */
    protected $responder;

    /**
     * Instantiate the class.
     *
     * @param \App\Domain\Services\Auth\LogoutService
     * @param \App\Responders\Auth\LogoutResponder
     */
    public function __construct(LogoutService $service, LogoutResponder $responder)
    {
        $this->service   = $service;
        $this->responder = $responder;
    }

    /**
     * Invoke our action, handle domain, respond.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return $this->responder->make(
            $this->service->handle($request)
        )->send();
    }
}