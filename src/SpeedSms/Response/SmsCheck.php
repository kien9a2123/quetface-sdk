<?php

namespace Quetface\SpeedSms\Response;

use Quetface\HasJsonResponse;
use Quetface\JsonResponse;

class SmsCheck extends SpeedSmsResponse
{
    /**
     * Get phone, status in position key
     *
     * @param integer $key
     * @return mixed
     */
    public function get(int $key)
    {
        $this->response[$key];
    }

    /**
     * Get status name from data element
     *
     * @param mixed $phoneStatus
     * @return string|null
     */
    public function status($element)
    {
        $status = [
            0 => 'pending',
            1 => 'sending',
            2 => 'success',
            3 => 'error'
        ];

        return $status[$element->status] ?? null;
    }

    /**
     * Get phone number from data elemt
     *
     * @param mixed $element
     * @return string
     */
    public function phone($element)
    {
        return $element->phone ?? null;
    }

    /**
     * Get all list phone and status
     *
     * @return mixed
     */
    public function all()
    {
        return $this->response ?? [];
    }
}
