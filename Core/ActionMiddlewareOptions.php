<?php

namespace Serenity\Lotus\Core;

class ActionMiddlewareOptions
{
    /**
     * The middleware options.
     *
     * @var array
     */
    protected $options;

    /**
     * Create a new middleware option instance.
     *
     * @param  array  $options
     * @return void
     */
    public function __construct(array &$options)
    {
        $this->options = &$options;
    }

    /**
     * Set the actions the middleware should apply to.
     *
     * @param  array|string|dynamic  $methods
     * @return $this
     */
    public function only($methods)
    {
        $this->options['only'] = is_array($methods) ? $methods : func_get_args();

        return $this;
    }

    /**
     * Set the actions the middleware should exclude.
     *
     * @param  array|string|dynamic  $methods
     * @return $this
     */
    public function except($methods)
    {
        $this->options['except'] = is_array($methods) ? $methods : func_get_args();

        return $this;
    }
}
