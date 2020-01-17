<?php

namespace Quetface\Scan\Callback;

use Quetface\HasJsonCallback;

class UidToPhoneConverter extends HasJsonCallback
{
    /**
     * Get id of file converted
     *
     * @return string
     */
    public function id()
    {
        return (string) $this->id;
    }

    /**
     * Get output link download
     *
     * @return string
     */
    public function outputLink()
    {
        return $this->outputUrl;
    }

    /**
     * Count total phone number has converter success
     *
     * @return int
     */
    public function count()
    {
        return (int) $this->phoneNumbers;
    }
}
