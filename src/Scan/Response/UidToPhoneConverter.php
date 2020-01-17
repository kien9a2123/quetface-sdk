<?php

namespace Quetface\Scan\Response;

use Quetface\HasJsonResponse;
use Quetface\JsonResponse;

class UidToPhoneConverter extends HasJsonResponse
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
