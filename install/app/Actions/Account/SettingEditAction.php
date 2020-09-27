<?php

namespace App\Actions\Account;

use Serenity\Lotus\Core\Action;
use Illuminate\Http\Request;
use App\Domain\Services\Account\SettingService;
use App\Responders\Account\SettingEditResponder;

class SettingEditAction extends Action
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
     * Create a new action instance.
     *
     * @param \App\Responders\Account\SettingEditResponder
     * @param \App\Domain\Services\Account\SettingService
     */
    public function __construct(SettingEditResponder $responder, SettingService $service)
    {
        $this->responder = $responder;
        $this->service   = $service;
    }

    /**
     * Invoke our action, handle domain.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return $this->responder->make(
            $this->service->handle($request->user())
        )->send();
    }
}
