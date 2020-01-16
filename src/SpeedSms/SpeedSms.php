<?php

namespace Quetface\SpeedSms;

use Quetface\QuetfaceException;
use Quetface\SpeedSms\Response\Sms;
use Quetface\SpeedSms\Response\User;

class SpeedSms extends Base
{
    /**
     * Advertising message type
     */
    const SMS_ADS = 1;

    /**
     * Support message type
     * Send from random phone number
     */
    const SMS_SUPPORT = 2;

    /**
     * Using brandname to send
     */
    const SMS_BRANDNAME = 3;

    /**
     * SMS send by default brandname "Notify"
     */
    const SMS_BRANDNAME_NOTIFY = 4;

    /**
     * Sms send by personal phone number
     * @see https://play.google.com/store/apps/details?id=com.speedsms.gateway
     */
    const SMS_GATEWAY = 5;

    /**
     * Send by fixed number "0901756186"
     */
    const SMS_FIXED_NUMBER = 6;

    /**
     * Send by private number has register in SpeedSMS
     */
    const SMS_OWN_NUMBER = 7;

    /**
     * Send by fixed number two way
     */
    const SMS_TWO_WAY_NUMBER = 8;

    /**
     * Get info current user
     *
     * @return Quetface\SpeedSms\Response\User
     */
    public function getUserInfo()
    {
        $response = $this->request('/user/info', [], 'GET');
        return new User($response);
    }

    /**
     * Send sms to a phone number
     *
     * @param array $phone phone number to send
     * @param string $message content of message
     * @param integer $type 
     * @param string $sender brandname or phone number has register in SpeedSMS
     * @return Quetface\SpeedSms\Response\Sms
     */
    public function sendSms(string $phone, string $message, int $type = 2, string $sender = '')
    {
        return $this->sendListSms([$phone], $message, $type, $sender);
    }

    /**
     * Send sms to list phone number
     *
     * @param array $to list number to send
     * @param string $message content of message
     * @param integer $type 
     * @param string $sender brandname or phone number has register in SpeedSMS
     * @throws Quetface\QuetfaceException
     * @return Quetface\SpeedSms\Response\Sms
     */
    public function sendListSms(array $listPhone, string $message, int $type = 2, string $sender = '')
    {
        $this->checkSmsMessage($message);

        foreach (range(0, 100) as $i) {
            if (! isset($listPhone[$i])) break;
        }

        if ($i === 100) {
            throw new QuetfaceException("Can be send only 100 phone number in a times");
        }

        $response = $this->request('/sms/send', [
            'to'       => $listPhone,
            'content'  => $message,
            'sms_type' => $type,
            'sender'   => $sender
        ]);

        return new Sms($response);
    }

    /**
     * Undocumented function
     *
     * @param string $to
     * @param string $message
     * @return Quetface\JsonResponse
     */
    public function sendVoice(string $phoneNumber, string $message)
    {
        return $this->request('voice/otp', [
            'to'      => $phoneNumber,
            'content' =>  $message
        ]);
    }

    /**
     * Check message is valid or not
     *
     * @param string $message
     * @return boolean
     */
    public function canSendMessage(string $message)
    {
        try {
            $this->checkSmsMessage($message);
        } catch (\Throwable $th) {
            return false;
        }

        return true;
    }

    /**
     * Check a sms message
     *
     * @param string $message
     * @return void
     */
    private function checkSmsMessage(string $message)
    {
        if (empty($message)) {
            throw new QuetfaceException("Message can't empty", 1);
        }

        $length = strlen($message);
        if ($length != strlen(utf8_decode($message)) && $length > 60)
        {
            throw new QuetfaceException(
            "Message contain unicode should less 
            than or equal 60 character length", 1);
        }

        if ($length > 160) {
            throw new QuetfaceException("Message should less than or equal 160 character length", 1);
        }
    }
}
