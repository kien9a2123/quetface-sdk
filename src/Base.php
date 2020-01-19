<?php

namespace Quetface;

abstract class Base
{
    protected $endpoint;

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

    /**
     * Set endpoint to url
     *
     * @param string $url
     * @return void
     */
    protected function setEndpoint(string $url)
    {
        $this->endpoint = $url;
    }

    /**
     * Set access key for endpoint
     *
     * @param string $key
     * @return void
     */
    protected function setEndpointKey(string $key)
    {
        $this->endpointKey = $key
    }
}
