<?php

namespace Quetface\SpeedSms\Response;

use Quetface\SpeedSms\Response\SpeedSmsResponse;

class Sms extends SpeedSmsResponse
{
    /**
     * Get transaction ID
     *
     * @return int|null
     */
    public function tranId()
    {
        return $this->tranId;
    }

    /**
     * Undocumented function
     *
     * @return string|null
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * Count total sms has send
     *
     * @return int
     */
    public function total()
    {
        return $this->totalSMS;
    }

    /**
     * Total price
     *
     * @return int
     */
    public function price()
    {
        return $this->totalPrice;
    }

    /**
     * Get list invalid phone number can't send
     *
     * @return array
     */
    public function invalidPhone()
    {
        return $this->invalidPhone;
    }
}
