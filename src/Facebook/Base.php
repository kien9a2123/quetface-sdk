<?php

namespace Quetface\Facebook;

use Quetface\JsonResponse;
use Quetface\QuetfaceException;
use Quetface\Base as BaseController;

class Base extends BaseController
{
    /**
     * Endpoint of facebook graph api
     *
     * @var string
     */
    protected $endpoint = 'https://graph.facebook.com/';

    /**
     * Access token form facebook account
     *
     * @var string
     */
    protected $endpointKey;

    /**
     * Make a request to graph facebook API
     *
     * @param string $link
     * @param array $params
     * 
     * @throws Quetface\QuetfaceException
     * 
     * @return mixed
     */
    protected function request(string $link, array $params = [])
    {
        $params  = $this->buildHttpParams($params);
        $context = $this->buildHttpContext(['ignore_errors' => true]);

        $url  = $this->endpoint . trim($link, '/');
        $url .= '?access_token=' . $this->endpointKey;
        $url .= '&' . $params;

        $response = file_get_contents($url, false, $context);
        $response = new JsonResponse($response);

        if (isset($response->error)) {
            throw new QuetfaceException($response->error->message);
        }

        return $response;
    }
}
