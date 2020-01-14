<?php

namespace Quetface;

use Quetface\Facebook\Facebook;
use Quetface\Facebook\Graph;
use Quetface\Scan\Scan;

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

    public function __construct($options = null) {

        $this->options     = $options;
        $this->accessToken = $options['access-token'] ?? '';
        $this->scanKey     = $options['scan-key'] ?? '';
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
}
