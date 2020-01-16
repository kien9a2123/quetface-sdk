<?php

namespace Quetface\SpeedSms;

class SpeedSmsTwoFactor extends Base
{
    public function createPin(string $phoneNumber, string $pinCode, string $appId)
    {
        return $this->request('/pin/create', [
            'to'      => $phoneNumber,
            'content' => $pinCode,
            'app_id'  => $appId
        ]);
    }

    public function verifyPin(string $phoneNumber, string $pinCode, string $appId)
    {
        return $this->request('', [
            'phone'    => $phoneNumber,
            'pin_code' => $pinCode,
            'app_id'   => $appId
        ]);
    }
}
