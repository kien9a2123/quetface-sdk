<?php

namespace Quetface;

use Quetface\JsonResponse;

class HasJsonResponse
{
    protected $response;

    public function __construct(JsonResponse $jsonResponse) {
        $this->checkResponse($jsonResponse);
        $this->response = $jsonResponse;
    }

    protected function checkResponse($response)
    {
        if (! ($response instanceof JsonResponse)) {
            throw new QuetfaceException('Response it\'s not instance of JsonResponse');
        }
    }

    public function __get(string $name)
    {
        return $this->response->$name ?? null;
    }

    public function __toString()
    {
        return json_encode($this->response);
    }
}
