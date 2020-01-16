<?php

namespace Quetface\SpeedSms\Response;

use Quetface\HasJsonResponse;

class SpeedSmsResponse
{
    use HasJsonResponse;

    public function __construct($response) {
        parent::__construct($response);
        $this->response = $this->response->data;
    }
}
