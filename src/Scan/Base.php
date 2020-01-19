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
     * @return Quetface\JsonResponse
     * @throws Quetface\QuetfaceException
     */
    public function request(string $link, array $params = [])
    {
        $params  = $this->buildHttpParams($params);
        $context = $this->buildHttpContext(['ignore_errors' => true]);

        $url  = $this->endpoint . trim($link, '/');
        $url .= "?key=$this->endpointKey&$params";

        $response = file_get_contents($url, false, $context);
        $response = new JsonResponse($response);

        if (isset($response->success) && $response->success == 'error') {
            throw new QuetfaceException($response->message);
        }

        return $response;
    }

    /**
     * Create custom request to Quetface API
     *
     * @param string $link
     * @param array $httpParams
     * @return Quetface\JsonResponse
     */
    public function customRequest(string $link, array $httpParams = [])
    {
        $httpParams = array_merge($httpParams, ['ignore_errors' => true]);
        $context = $this->buildHttpContext($httpParams);

        $url = trim($link, '/') .'/'. trim($link) . "?key=$this->endpointKey";

        $response = file_get_contents($url, false, $context);

        if (isset($response->success) && $response->success == 'error') {
            throw new QuetfaceException($response->message);
        }

        return new JsonResponse($response);
    }

    /**
     * Build file http param
     *
     * @param mixed $fileContent
     * @param string $formField
     * @param string $filename
     * @return array http header
     */
    protected function buildFileHttp($fileContent, string $formField = 'file', string $filename = 'file')
    {
        $boundary = '--------------------------'.microtime(true);

        $content =  "--".$boundary."\r\n".
            "Content-Disposition: form-data; name=\"".$formField."\"; filename=\"".basename($filename)."\"\r\n".
            "Content-Type: application/zip\r\n\r\n".
            $fileContent."\r\n";
        $content .= "--".$boundary."--\r\n";

        return [
            'method' => 'POST',
            'header' => 'Content-Type: multipart/form-data; boundary='.$boundary,
            'content'=> $content
        ];
    }
}
