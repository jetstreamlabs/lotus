<?php

namespace App\Actions\Auth;

use Illuminate\Http\Request;
use Serenity\Lotus\Core\Action;
use App\Domain\Services\Auth\PasswordService;
use App\Responders\Auth\PasswordStoreResponder;
use App\Domain\Requests\Auth\ForgotPasswordRequest;

class PasswordStoreAction extends Action
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
     * @param \App\Domain\Services\Auth\PasswordService
     * @param \App\Responders\Auth\PasswordStoreResponder
     */
    public function __construct(PasswordService $service, PasswordStoreResponder $responder)
    {
        $this->service   = $service;
        $this->responder = $responder;
    }

    /**
     * Invoke our action, handle domain, respond.
     *
     * @param  \App\Domain\Requests\Auth\ForgotPasswordRequest
     * @return \Illuminate\Http\Response
     */
    public function __invoke(ForgotPasswordRequest $request)
    {
        return $this->service->handle($request);
    }
}
