<?php

namespace Quetface\Facebook;

use Quetface\Facebook\Response\User;
use Quetface\QuetfaceException;

class Facebook extends Base
{
    /**
     * Get information facebook user
     *
     * @param string $id username or uid
     * 
     * @throws Quetface\QuetfaceException
     * 
     * @return Quetface\Facebook\Response\User
     */
    public function user(string $id)
    {
        $response = $this->request($id);
        return new User($response);
    }

    /**
     * Get user id or username form url facebook given
     *
     * @param string $url
     * @return string|null
     */
    public function parseUserLink(string $url)
    {
        $facebookDomain = [
            'facebook.com',
            'fb.me',
            'fb.com',
            'www.facebook.com'
        ];

        //in case user paste link contain .../profile.php?id=
        preg_match('/profile\.php\?id=(.*?)$/', $url, $matches);
        if (count($matches)) {
            return explode('&', $matches[1])[0];
        }

        //in case user paste link https://facebook.com/abc
        if ($this->strContains($url, ['https://', 'http://']) 
            && $this->strContains($url, $facebookDomain)) {

            $user = explode('/', $url);
            $user = isset($user[3]) ? $user[3] : null;
            $user = explode('?', $user)[0];
            return $user;
        }

        // if user paste link like facebook.com/abc or fb.com/abc
        if ($this->strContains($url, $facebookDomain)) {
            $user = explode('/', $url);
            $user = isset($user[1]) ? $user[1] : null;

            return $user != null ? $user = explode('?', $user)[0] : null;
        }

        return null;
    }

    /**
     * Check string contains a value or not
     *
     * @param string $haystack
     * @param mixed $needle
     * @return boolean
     */
    private function strContains(string $haystack, $needle)
    {
        if (is_string($needle)) {
            return strpos($haystack, $needle) !== false ? true : false;
        }

        if (!is_array($needle)) {
            throw new QuetfaceException("Data type not supported");
        }

        foreach ($needle as $value) {
            if (strpos($haystack, $value) !== false) {
                return true;
            }
        }

        return false;
    }
}
