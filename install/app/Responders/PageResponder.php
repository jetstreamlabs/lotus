<?php

namespace App\Responders;

use Serenity\Lotus\Core\Responder;

class PageResponder extends Responder
{
    /**
     * View template property.
     *
     * @var string
     */
    protected $template;

    /**
     * Build up a response and return it to our action.
     *
     * @return \Illuminate\View\Factory
     */
    public function send()
    {
        $this->template = $this->setTemplate();

        $data = $this->payload->getData();

        return $this->view->make($this->template, $data);
    }

    /**
     * Set our template from payload data.
     *
     * @return string
     */
    protected function setTemplate()
    {
        if (isset($this->payload->meta['view'])) {
            return $this->payload->meta['view'];
        }

        return 'page';
    }
}
