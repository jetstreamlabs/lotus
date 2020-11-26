<?php

namespace Serenity\Lotus\Core;

use Inertia\ResponseFactory;
use Serenity\Lotus\Contracts\PayloadContract;
use Serenity\Lotus\Contracts\ResponderContract;

abstract class VueResponder implements ResponderContract
{
    /**
     * Local payload property.
     *
     * @var \Serenity\Lotus\Contracts\PayloadContract
     */
    protected $payload;

    /**
     * View factory instance.
     *
     * @var \Inertia\ResponseFactory
     */
    protected $view;

    /**
     * The name of the actual Vue component.
     *
     * @var string
     */
    protected $component;

    /**
     * Does the given action require a payload?
     *
     * @var boolean
     */
    protected $expectsPayload = true;

    /**
     * Instantiate the class.
     *
     * @param \Inertia\ResponseFactory
     */
    public function __construct(ResponseFactory $factory)
    {
        $this->view = $factory;
        $this->view->setRootView('layouts.vue');

        return $this;
    }

    /**
     * Build up the HTTP response.
     *
     * @param  \Serenity\Lotus\Contracts\PayloadContract
     * @return mixed
     */
    public function make(PayloadContract $payload)
    {
        $this->payload = $payload;

        return $this;
    }

    /**
     * Setter for our component.
     *
     * @param string $component
     */
    public function setComponent(string $component)
    {
        $this->component = $component;

        return $this;
    }

    /**
     * Let the responder know if the action needs a payload.
     *
     * @return void
     */
    public function expectsPayload(bool $expects)
    {
        $this->expectsPayload = $expects;

        return $this;
    }
}
