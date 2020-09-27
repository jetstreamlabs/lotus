<?php

namespace Serenity\Lotus\Core;

use BadMethodCallException;
use Serenity\Lotus\Contracts\ActionContract;
use Serenity\Lotus\Core\ActionMiddlewareOptions;

abstract class Action implements ActionContract
{
    /**
     * The middleware registered on the action.
     *
     * @var array
     */
    protected $middleware = [];

    /**
     * Register middleware on the action.
     *
     * @param  array|string|\Closure  $middleware
     * @param  array   $options
     * @return \Serenity\Lotus\Core\ActionMiddlewareOptions
     */
    public function middleware($middleware, array $options = [])
    {
        foreach ((array) $middleware as $m) {
            $this->middleware[] = [
                'middleware' => $m,
                'options'    => &$options,
            ];
        }

        return new ActionMiddlewareOptions($options);
    }

    /**
     * Get the middleware assigned to the action.
     *
     * @return array
     */
    public function getMiddleware()
    {
        return $this->middleware;
    }

    /**
     * Handle calls to missing methods on the action.
     *
     * @param  string  $method
     * @param  array   $parameters
     * @return mixed
     *
     * @throws \BadMethodCallException
     */
    public function __call($method, $parameters)
    {
        throw new BadMethodCallException(sprintf(
            'Method %s::%s does not exist.', static::class, $method
        ));
    }
}
