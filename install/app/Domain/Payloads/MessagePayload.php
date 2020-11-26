<?php

namespace App\Domain\Payloads;

use Serenity\Lotus\Core\Payload;

class MessagePayload extends Payload
{
    /**
     * Return the data properties.
     *
     * @return array
     */
    public function getData()
    {
        $message = $this->data['message'];
        $level   = $this->data['level'];

        flash($message)->{$level}();

        if (! empty($this->data['route'])) {
            return [
                'route' => $this->data['route']
            ];
        }
    }
}
