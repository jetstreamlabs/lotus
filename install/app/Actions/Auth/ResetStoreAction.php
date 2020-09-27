<?php

namespace App\Actions\Auth;

use Illuminate\Http\Request;
use Serenity\Lotus\Core\Action;
use App\Domain\Services\Auth\ResetService;

class ResetStoreAction extends Action
{
    /**
     * Service property for contacting the domain.
     *
     * @var \App\Domain\Services\ResetService
     */
    protected $service;

    /**
     * Instantiate the class.
     *
     * @param \App\Domain\Services\ResetService
     */
    public function __construct(ResetService $service)
    {
        $this->service = $service;
    }

    /**
     * Invoke our action, handle domain, respond.
     *
     * Reset returns a redirect response.
     *
     * @param  \Illuminate\Http\Request
     * @return \App\Domain\Services\ResetService
     */
    public function __invoke(Request $request)
    {
        return $this->service->handle($request);
    }
}
