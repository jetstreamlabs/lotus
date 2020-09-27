<?php

namespace Serenity\Lotus\Contracts;

interface ResponderContract
{
    /**
     * Build up a response and return it to our action.
     *
     * @return \Inertia\ResponseFactory
     */
    public function send();
}
