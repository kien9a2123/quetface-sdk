<?php

namespace Quetface\Scan\Response;

use Quetface\HasJsonResponse;
use Quetface\JsonResponse;

class Scanned extends HasJsonResponse
{
    public function __construct(JsonResponse $jsonResponse) {
        $this->checkResponse($jsonResponse);
        $this->response = $jsonResponse->data;
    }

    /**
     * Get phone number from response
     *
     * @return string|null
     */
    public function getPhone()
    {
        return $this->response->number ?? null;
    }

    /**
     * Get link facebook from response
     *
     * @return string|null
     */
    public function getLinkFacebook()
    {
        return $this->response->linkFb ?? null;
    }

    /**
     * Get uid facebook from response
     *
     * @return void
     */
    public function getUid()
    {
        if (! $this->getLinkFacebook()) {
            return null;
        }

        $link = explode('/', $this->getLinkFacebook());

        return $link[count($link) -1];
    }
}
