<?php

namespace App\Actions;

use Serenity\Lotus\Core\Action;
use Illuminate\Http\Request;
use App\Domain\Entities\Page;
use App\Responders\PageResponder;
use App\Domain\Services\PageService;

class PageAction extends Action
{
    /**
     * Local responder instance.
     *
     * @var \App\Responders\PageResponder
     */
    protected $responder;

    /**
     * Local service instance.
     *
     * @var \App\Domain\Services\PageService
     */
    protected $service;

    /**
     * Create a new action instance.
     *
     * @param \App\Responders\PageResponder $responder
     * @param \App\Domain\Services\PageService $service
     */
    public function __construct(PageResponder $responder, PageService $service)
    {
        $this->responder = $responder;
        $this->service   = $service;
    }

    /**
     * Invoke our action, handle domain, respond.
     *
     * @param \Illuminate\Http\Request $request
     * @return \App\Responders\PageResponder
     */
    public function __invoke(Request $request)
    {
        return $this->responder->make(
            $this->service->handle($request)
        )->send();
    }
}
