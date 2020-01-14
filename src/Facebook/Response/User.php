<?php

namespace Quetface\Facebook\Response;

class User
{
    /**
     * Response from request
     *
     * @var mixed
     */
    protected $response;

    public function __construct($response) {
        $this->response = $response;
    }

    /**
     * Get id profile
     *
     * @return string|null
     */
    public function id()
    {
        return $this->get(__FUNCTION__);
    }

    /**
     * Get about
     *
     * @return string|null
     */
    public function about()
    {
        return $this->get(__FUNCTION__);
    }

    /**
     * Get birthday
     *
     * @return string|null
     */
    public function birthday()
    {
        return $this->get(__FUNCTION__);
    }

    /**
     * Get name
     *
     * @return string|null
     */
    public function name()
    {
        return $this->get(__FUNCTION__);
    }

    /**
     * Get username
     *
     * @return string|null
     */
    public function username()
    {
        return $this->get(__FUNCTION__);
    }

    /**
     * Get first name
     *
     * @return string|null
     */
    public function firstName()
    {
        return $this->get(__FUNCTION__);
    }

    /**
     * Get last name
     *
     * @return string|null
     */
    public function lastName()
    {
        return $this->get(__FUNCTION__);
    }

    /**
     * Get gender
     *
     * @return string|null
     */
    public function gender()
    {
        return $this->get(__FUNCTION__);
    }

    /**
     * Get language from user 
     *
     * @return array|null
     */
    public function languages()
    {
        return $this->get(__FUNCTION__);
    }

    public function location()
    {
        return $this->get(__FUNCTION__);
    }

    /**
     * Get link profile
     *
     * @return string|null
     */
    public function link()
    {
        return $this->get(__FUNCTION__);
    }

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
     * Get all attribute form user
     *
     * @return mixed
     */
    public function all()
    {
        return $this->response;
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

    public function __toString()
    {
        return json_encode($this->response);
    }
}
