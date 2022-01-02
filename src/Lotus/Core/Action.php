<?php

namespace Serenity\Lotus\Core;

use BadMethodCallException;
use Serenity\Lotus\Contracts\ActionInterface;
use Serenity\Lotus\Contracts\ResponderInterface;
use Serenity\Lotus\Contracts\ServiceInterface;

abstract class Action implements ActionInterface
{
	/**
	 * All actions must have a responder that implements
	 * the ResponderInterface.
	 *
	 * @var \Serenity\Lotus\Contracts\ResponderInterface
	 */
	protected ResponderInterface $responder;

	/**
	 * If an action has a service it must be an instance
	 * that implements the ServiceInterface.
	 *
	 * @var \Serenity\Lotus\Contracts\ServiceInterface
	 */
	protected ServiceInterface $service;

	/**
	 * The middleware registered on the controller.
	 *
	 * @var array
	 */
	protected array $middleware = [];

	/**
	 * Register middleware on the controller.
	 *
	 * @param \Closure|array|string $middleware
	 * @param array                 $options
	 *
	 * @return \Serenity\Lotus\Core\Options
	 */
	public function middleware($middleware, array $options = []): Options
	{
		foreach ((array) $middleware as $m) {
			$this->middleware[] = [
				'middleware' => $m,
				'options'    => &$options,
			];
		}

		return new Options($options);
	}

	/**
	 * Get the middleware assigned to the controller.
	 *
	 * @return array
	 */
	public function getMiddleware(): array
	{
		return $this->middleware;
	}

	/**
	 * Resolve the responder and return for chaining.
	 *
	 * @param \Serenity\Lotus\Contracts\ResponderInterface $responder
	 *
	 * @return \Serenity\Lotus\Core\Action
	 */
	public function resolve(ResponderInterface $responder): Action
	{
		$this->responder = $responder;

		return $this;
	}

	/**
	 * Set the component file, and payload expectation, then
	 * return the class for chaining.
	 *
	 * @param string $component
	 * @param bool   $expects
	 *
	 * @return \Serenity\Lotus\Core\Action
	 */
	public function with(string $component, bool $expects = false): Action
	{
		$this->responder->setComponent($component)
			->expectsPayload($expects);

		return $this;
	}

	/**
	 * Set the passed in service to the action and then return
	 * for chaining.
	 *
	 * @param \Serenity\Lotus\Contracts\ServiceInterface $service
	 *
	 * @return void
	 */
	public function serve(ServiceInterface $service)
	{
		$this->service = $service;

		return $this;
	}

	/**
	 * Execute a method on the Action.
	 *
	 * @param string $method
	 * @param array  $parameters
	 *
	 * @return mixed
	 */
	public function callAction($method, $parameters)
	{
		return $this->{$method}(...array_values($parameters));
	}

	/**
	 * Handle calls to missing methods on the controller.
	 *
	 * @param string $method
	 * @param array  $parameters
	 *
	 * @throws \BadMethodCallException
	 *
	 * @return mixed
	 */
	public function __call($method, $parameters): BadMethodCallException
	{
		throw new BadMethodCallException(sprintf(
			'Method %s::%s does not exist.',
			static::class,
			$method
		));
	}
}
