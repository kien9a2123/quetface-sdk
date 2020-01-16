<?php

namespace Quetface;

use Quetface\Facebook\Facebook;
use Quetface\Facebook\Graph;
use Quetface\Scan\Scan;
use Quetface\SpeedSms\SpeedSms;

class Quetface
{
    /**
     * All options
     *
     * @var string
     */
    protected $options;

    /**
     * Key for quetface API
     *
     * @var string
     */
    protected $scanKey;

    /**
     * Access token from user facebook
     *
     * @var string
     */
    protected $accessToken;

    /**
     * Access key for SpeedSMS
     *
     * @var string
     */
    protected $speedSmsKey;

    /**
     * Mapping options key
     *
     * @param array $options
     */
    public function __construct(array $options = []) {

        $this->options     = $options;
        $this->accessToken = $options['access-token'] ?? '';
        $this->scanKey     = $options['scan-key'] ?? '';
        $this->speedSmsKey = $options['sms-key'] ?? '';
    }

    /**
     * Create Facebook instance
     *
     * @param string $accessToken
     * @return Quetface\Facebook\Facebook
     */
    public function facebook($accessToken = null)
    {
        $graph = new Graph($accessToken ?? $this->accessToken);
        return new Facebook($accessToken ?? $this->accessToken, $graph);
    }

    /**
     * Create Scan instance
     *
     * @param string $scanKey
     * @return Quetface\Scan\Scan
     */
    public function scan($scanKey = null)
    {
        return new Scan($scanKey ?? $this->scanKey);
    }

    /**
     * Create SpeedSMS instance
     *
     * @param string $accessKey
     * @return Quetface\SpeedSms\SpeedSms
     */
    public function sms($accessKey = null)
    {
        return new SpeedSms($accessKey ?? $this->speedSmsKey);
    }
}
