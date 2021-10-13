<?php

namespace Serenity\Lotus\Core;

use Illuminate\Contracts\View\Factory;
use Serenity\Lotus\Contracts\PayloadInterface;
use Serenity\Lotus\Contracts\ResponderInterface;

abstract class BladeResponder implements ResponderInterface
{
	/**
	 * Local payload property.
	 *
	 * @var PayloadInterface
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
	 * @param  PayloadInterface
	 * @return mixed
	 */
	public function make(PayloadInterface $payload)
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
