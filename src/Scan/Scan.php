<?php

namespace Quetface\Scan;

use Quetface\Scan\Response\Scanned;

class Scan extends Base
{
    /**
     * Scan user facebook by phone
     *
     * @param string $number
     * @return Quetface\Scan\Response\Scanned|null
     */
    public function phone(string $number)
    {
        $response = $this->request('phone/info/web', ['number' => $number]);

        return new Scanned($response)
    }

    /**
     * Scan user facebook by uid
     *
     * @param string $uid
     * @return Quetface\Scan\Response\Scanned|null
     */
    public function uid(string $uid)
    {
        $response = $this->request('phone/info/web', ['uid' => $uid]);

        return new Scanned($response);
    }

}
