<?php

namespace App\Actions\Auth;

use Illuminate\Http\Request;
use Serenity\Lotus\Core\Action;
use App\Domain\Requests\Auth\LoginRequest;
use App\Domain\Services\Auth\LoginService;
use App\Responders\Auth\LoginStoreResponder;

class LoginStoreAction extends Action
{
    /**
     * @var \Serenity\Lotus\Contracts\ServiceContract
     */
    protected $service;

    /**
     * @var \Serenity\Lotus\Contracts\ResponderContract
     */
    protected $responder;

    /**
     * Instantiate the class.
     *
     * @param \App\Domain\Services\LoginService
     * @param \App\Responders\Auth\LoginStoreResponder
     */
    public function __construct(LoginService $service, LoginStoreResponder $responder)
    {
        $this->service   = $service;
        $this->responder = $responder;
    }

    /**
     * Invoke our action, handle domain, respond.
     *
     * @param  \App\Domain\Requests\Auth\LoginRequest
     * @return \Illuminate\Http\Response
     */
    public function __invoke(LoginRequest $request)
    {
        return $this->responder->make(
            $this->service->handle($request->all())
        )->send();
    }
}
