<?php

namespace Quetface\SpeedSms\Callback;

use Quetface\HasJsonCallback;

class SmsIncoming extends HasJsonCallback
{
    /**
     * Get type
     *
     * @return string|null
     */
    public function type()
    {
        return $this->type;
    }

    /**
     * Get phone number
     *
     * @return string|null
     */
    public function phone()
    {
        return $this->phone;
    }

    /**
     * Get content of message
     *
     * @return string|null
     */
    public function message()
    {
        return $this->content;
    }
}
