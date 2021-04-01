<?php

namespace Serenity\Lotus\Contracts;

use Serenity\Lotus\Contracts\PayloadInterface;

interface ResponderInterface
{
    /**
     * Build up the HTTP response.
     *
     * @param  \Serenity\Lotus\Contracts\PayloadInterface
     * @return \Serenity\Lotus\Contracts\ResponderInterface
     */
    public function make(PayloadInterface $payload): ResponderInterface;

    /**
     * Let the responder know if the action needs a payload.
     *
     * @param  boolean $expects
     * @return \Serenity\Lotus\Contracts\ResponderInterface
     */
    public function expectsPayload(bool $expects = true): ResponderInterface;

    /**
     * Send a normal page response.
     *
     * @return mixed
     */
    public function send();

    /**
     * Send a proper redirect response.
     *
     * @return mixed
     */
    public function replace();
}
