<?php

namespace Quetface\Scan\Response;

use Quetface\QuetfaceException;

class Scanned
{
    /**
     * Response from quetface API
     *
     * @var mixed
     */
    protected $response;

    /**
     * Payload from response quetface API
     *
     * @var mixed
     */
    protected $data;

    public function __construct($response) {
        $this->response = $response;
        $this->data     = $response->data ?? null;
    }

    /**
     * Get phone number from response
     *
     * @return string|null
     */
    public function getPhone()
    {
        return $this->data->number ?? null;
    }

    /**
     * Get link facebook from response
     *
     * @return string|null
     */
    public function getLinkFacebook()
    {
        return $this->data->linkFb ?? null;
    }

    /**
     * Get uid facebook from response
     *
     * @return void
     */
    public function getUid()
    {
        if (! $this->getLinkFacebook()) {
            return null;
        }

        $link = explode('/', $this->getLinkFacebook());

        return $link[count($link) -1];
    }
}
