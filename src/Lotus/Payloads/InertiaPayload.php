<?php

namespace Serenity\Lotus\Payloads;

use Serenity\Lotus\Core\Payload;

class InertiaPayload extends Payload
{
    /**
     * Instantiate the payload class.
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }
}
