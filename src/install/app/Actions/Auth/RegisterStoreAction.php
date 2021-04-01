<?php

namespace App\Actions\Auth;

use Serenity\Lotus\Core\Action;
use App\Domain\Services\Auth\RegisterService;
use App\Domain\Requests\Auth\RegistrationRequest;
use App\Responders\Auth\RegistrationStoreResponder;

class RegisterStoreAction extends Action
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
     * @param \App\Domain\Services\RegisterService
     * @param \App\Responders\Auth\RegistrationStoreResponder
     */
    public function __construct(RegisterService $service, RegistrationStoreResponder $responder)
    {
        $this->service   = $service;
        $this->responder = $responder;
    }

    /**
     * Invoke our action, handle domain, respond.
     *
     * @param  \App\Domain\Requests\Auth\RegistrationRequest
     * @return \Illuminate\Http\Response
     */
    public function __invoke(RegistrationRequest $request)
    {
        return $this->responder->make(
            $this->service->handle($request->all())
        )->send();
    }
}
