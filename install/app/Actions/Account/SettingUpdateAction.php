<?php

namespace App\Actions\Account;

use Serenity\Lotus\Core\Action;
use App\Domain\Services\Account\SettingService;
use App\Responders\Account\SettingUpdateResponder;
use App\Domain\Requests\Account\SettingEditRequest;

class SettingUpdateAction extends Action
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
     * @param \App\Domain\Services\Account\SettingService
     * @param \App\Responders\Account\SettingUpdateResponder
     */
    public function __construct(SettingService $service, SettingUpdateResponder $responder)
    {
        $this->service   = $service;
        $this->responder = $responder;
    }

    /**
     * Invoke our action, handle domain.
     *
     * @param  \App\Domain\Requests\Account\SettingEditRequest
     * @return \Illuminate\Http\Response
     */
    public function __invoke(SettingEditRequest $request)
    {
        $payload = $this->service->update(
            $request->user()->id, $request->except('_token')
        );

        return $this->responder->make($payload)->send();
    }
}
