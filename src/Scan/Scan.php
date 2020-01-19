<?php

namespace Quetface\Scan;

use Quetface\Scan\Response\PhoneToUidConverter;
use Quetface\Scan\Response\Scanned;
use Quetface\Scan\Response\UidToPhoneConverter;
use Quetface\Scan\Response\UidToPhoneUidConverter;

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

        return new Scanned($response);
    }

    /**
     * Scan user facebook by uid
     *
     * @param string $uid
     * @return Quetface\Scan\Response\Scanned|null
     */
    public function uid(string $uid)
    {
        $response = $this->request('/phone/info/web', ['uid' => $uid]);

        return new Scanned($response);
    }

    /**
     * Converter uid to phone
     *
     * @param string $content
     * @return Quetface\Scan\Response\UidToPhoneConverter
     */
    public function converterUidToPhone(string $listUid)
    {
        $response = $this->sendContent('/convert/uid-to-phone', $listUid);
        return new UidToPhoneConverter($response);
    }

    /**
     * Converter phone to uid
     * support phone number bellow
     * +84978227691
     * 84978227691
     * 0978227691
     * 0978 227 691
     * 0978.227.691
     *
     * @param string $listPhone
     * @return void
     */
    public function converterPhoneToUid(string $listPhone)
    {
        $response = $this->sendContent('/convert/phone-to-uid', $listPhone);
        return new PhoneToUidConverter($response);
    }

    /**
     * Converter Uid To Phone-Uid
     *
     * @param string $listUid
     * @return  Quetface\Scan\Response\UidToPhoneUidConverter
     */
    public function converterUidToPhoneUid(string $listUid)
    {
        $response = $this->sendContent('convert/uid-to-uid-and-phone', $listUid);
        return new UidToPhoneUidConverter($response);
    }

    /**
     * Send file content to endpoint
     *
     * @param string $link
     * @param mixed $content
     * @return Quetface\JsonResponse
     */
    protected function sendContent(string $link, $content)
    {
        $httpHeader =$this->buildFileHttp($content);
        return $this->customRequest($link, $httpHeader);
    }

    /**
     * Create new callback quetface instance
     *
     * @return Quetface\Scan\ScanCallback;
     */
    public static function callback()
    {
        return new ScanCallback;
    }
}
