<?php

namespace Quetface\Facebook\Response;

use Quetface\HasJsonResponse;

/**
 * @method string|null id() Get id profile
 * @method string|null email() Get email profile
 * @method string|null about() Get about
 * @method string|null birthday() Get birthday
 * @method string|null name() Get name
 * @method string|null username() Get username
 * @method string|null firstName() Get first name
 * @method string|null lastName() Get last name
 * @method string|null gender() Get gender
 * @method array|null languages() Get language from user
 * @method array|null work() Get place has worked from user
 * @method mixed|null location() Get location from user
 * @method string|null link() Get link profile
 */
class User extends HasJsonResponse
{
    /**
     * Check user exist or not
     *
     * @return boolean
     */
    public function exist()
    {
        return $this->get('id') ? true : false;
    }

    /**
     * Get attribute from response
     *
     * @param string $attr
     * @return string|null
     */
    private function get(string $attr)
    {
        return $this->response->$attr ?? null;
    }

    public function __call($method, $args)
    {
        return $this->get($method);
    }
}
