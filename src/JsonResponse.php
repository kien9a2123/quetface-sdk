<?php

namespace Quetface;

class JsonResponse
{
    /**
     * Response from api website
     *
     * @var string
     */
    protected $response;

    public function __construct(string $response) {
        $this->response = $this->decodeJson($response);
    }

    /**
     * decode json message
     *
     * @param string $json
     * @return void
     */
    private function decodeJson(string $json)
    {
        $data = json_decode($json);

        if (json_last_error() !== JSON_ERROR_NONE && $data === null) {
            throw new QuetfaceException(json_last_error_msg());
        }

        return $data;
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
