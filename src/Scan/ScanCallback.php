<?php

namespace Quetface\Scan;

use Quetface\Scan\Callback\PhoneToUidConverter;
use Quetface\Scan\Callback\UidToPhoneConverter;

class ScanCallback
{
    /**
     * Create uid to phone callback
     *
     * @return Quetface\Scan\Callback\PhoneToUidConverter
     */
    public function uidToPhone()
    {
        return new UidToPhoneConverter;
    }

    /**
     * Create phone to Uid callback
     *
     * @return Quetface\Scan\Callback\PhoneToUidConverter
     */
    public function phoneToUid()
    {
        return new PhoneToUidConverter;
    }
}
