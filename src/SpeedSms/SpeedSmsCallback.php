<?php

namespace Quetface\SpeedSms;

use Quetface\SpeedSms\Callback\SmsIncoming;
use Quetface\SpeedSms\Callback\SmsStatus;

class SpeedSmsCallback
{
    public function incoming()
    {
        return new SmsIncoming;
    }

    public function status()
    {
        return new SmsStatus;
    }
}
