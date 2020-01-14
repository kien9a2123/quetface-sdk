<?php

namespace Quetface;

abstract class Base
{
    protected $endpointKey;

    public function __construct(string $endpointKey) {
        $this->endpointKey = $endpointKey;
    }

    abstract protected function request(string $link, array $params = []);

    /**
     * Create get query for url
     *
     * @param array $params
     * @return string
     */
    protected function buildHttpParams(array $params = [])
    {
        $result = '';

        foreach ($params as $key => $value) {
            $result .= "&$key=$value";
        }

        return trim($result, '&');
    }

    /**
     * Create steam http context
     *
     * @param array $params
     * @return resource A stream context resource.
     */
    protected function buildHttpContext(array $params = [])
    {
        return stream_context_create(['http' => $params]);
    }
}
