<?php

namespace Quetface\Scan\Response;

use Quetface\JsonResponse;

class ConverterResponse extends \Quetface\HasJsonResponse
{
    public function __construct(JsonResponse $jsonResponse) {
        $this->checkResponse($jsonResponse);
        $this->response = $jsonResponse->data;
    }

    /**
     * Get id of file converter has send
     *
     * @return string
     */
    public function id()
    {
        return (string) $this->id;
    }
}
