<?php

namespace App\Actions\Auth;

use Serenity\Lotus\Core\Action;
use App\Responders\Auth\ActivateResponder;
use App\Domain\Services\Auth\ActivateService;

class ActivateAction extends Action
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
     * Create a new action instance.
     *
     * @param \App\Domain\Services\Auth\ActivateService
     * @param \App\Responders\Auth\ActivateResponder
     */
    public function __construct(ActivateService $service, ActivateResponder $responder)
    {
        $this->service   = $service;
        $this->responder = $responder;
    }

    /**
     * Invoke our action, handle domain, respond.
     *
     * @param  string $activationToken
     * @return \Illuminate\Http\Response
     */
    public function __invoke($activationToken)
    {
        return $this->responder->make(
            $this->service->handle($activationToken)
        )->send();
    }
}
