<?php

namespace Serenity\Lotus\Core;

use Illuminate\Contracts\View\Factory;
use Serenity\Lotus\Contracts\PayloadContract;
use Serenity\Lotus\Contracts\ResponderContract;

abstract class BladeResponder implements ResponderContract
{
    /**
     * Local payload property.
     *
     * @var PayloadContract
     */
    protected $payload;

    /**
     * View factory instance.
     *
     * @var \Illuminate\Contracts\View\Factory
     */
    protected $view;

    /**
     * The path.name of the actual Blade view.
     *
     * @var string
     */
    protected $component;

    /**
     * Instantiate the class.
     *
     * @param \Illuminate\Contracts\View\Factory
     */
    public function __construct(Factory $factory)
    {
        $this->view = $factory;
    }

    /**
     * Build up the HTTP response.
     *
     * @param  PayloadContract
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
    }
}
