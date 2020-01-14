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

        return !$this->isFailed($response) ? new Scanned($response) : null;
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

        return !$this->isFailed($response) ? new Scanned($response) : null;
    }

    /**
     * Check request to quetface api failed or not
     *
     * @param mixed $response
     * @return boolean
     */
    public function isFailed($response)
    {
        if (isset($response->status) && $response->status === 'fail') {
            return true;
        }

        if (isset($response->success) && $response->success === 'error') {
            return true;
        }

        return false;
    }
}
