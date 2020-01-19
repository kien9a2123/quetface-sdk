<?php

namespace Quetface\Scan;

use Quetface\Scan\Callback\PhoneToUidConverter;
use Quetface\Scan\Callback\UidToPhoneConverter;
use Quetface\Scan\Callback\UidToPhoneUidConverter;

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

    /**
     * Create uid to phone-uid callback
     *
     * @return Quetface\Scan\Callback\UidToPhoneUidConverter
     */
    public function uidToPhoneUid()
    {
        return new UidToPhoneUidConverter;
    }
}
