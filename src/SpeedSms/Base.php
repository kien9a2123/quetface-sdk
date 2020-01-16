<?php

namespace Quetface\SpeedSms;

use Quetface\JsonResponse;
use Quetface\Base as BaseController;
use Quetface\QuetfaceException;

class Base extends BaseController
{
    /**
     * Endpoint API URL SMS
     *
     * @var string
     */
    protected $endpoint = 'https://api.speedsms.vn/index.php';

    /**
     * Api access token
     *
     * @var string
     */
    protected $endpointKey;

    /**
     * Send a request to SpeedSMS API
     *
     * @param string $link
     * @param array $params
     * @param string $method
     * @throws Quetface\QuetfaceException
     * @return Quetface\JsonResponse
     */
    protected function request(string $link, array $params = [], string $method = 'POST')
    {
        $header = [
            'Accept: application/json',
            'Content-type: application/json',
            'Authorization: Basic ' . base64_encode($this->endpointKey . ':x')
        ];

        $context = $this->buildHttpContext([
            'ignore_errors' => true,
            'header'        => $this->buildHttpHeader($header),
            'method'        => $method,
            'content'       => json_encode($params)
        ]);

        $url = $this->endpoint . '/' .trim($link, '/');

        $response = file_get_contents($url, false, $context);
        $response =  new JsonResponse($response);

        if ($response->status == 'error') {
            throw new QuetfaceException($response->message);
        }

        return $response;
    }

    protected function buildHttpHeader(array $params = [])
    {
        return implode("\r\n", $params) . "\r\n";
    }
}
