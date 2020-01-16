<?php

namespace Quetface\Scan;

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
    protected $endpoint = 'https://quetface.com/api/';

    /**
     * Access token form facebook account
     *
     * @var string
     */
    protected $endpointKey;

    /**
     * Make a request for Quetface API
     *
     * @param string $link
     * @param array $params
     * @return mixed
     * @throws Quetface\QuetfaceException
     */
    public function request(string $link, array $params = [])
    {
        $params  = $this->buildHttpParams($params);
        $context = $this->buildHttpContext(['ignore_errors' => true]);

        $url  = $this->endpoint . trim($link, '/');
        $url .= "?key=$this->endpointKey&$params";

        $response = file_get_contents($url, false, $context);
        $response = json_decode($response);

        if (isset($response->success) && $response->success == 'error') {
            throw new QuetfaceException($response->message);
        }

        return new JsonResponse($response);
    }
}
