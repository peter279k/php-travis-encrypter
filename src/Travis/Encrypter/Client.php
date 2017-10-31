<?php

/**
 * PHP version 5
 *
 * This is the Travis Encrypter PHP API wrapper
 *
 * @category Travis_Encrypter_API
 * @author   peter279k <peter279k@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 */

namespace Travis\Encrypter;

class Client {

    const WRAPPER_VERSION = Config::WRAPPER_VERSION;

    /**
     * connect_timeout: (float, default=2) Float describing the number of
     * seconds to wait while trying to connect to a server. Use 0 to wait
     * indefinitely (the default behavior).
     */
    const CONNECT_TIMEOUT = 'connect_timeout';

    /**
     * timeout: (float, default=15) Float describing the timeout of the
     * request in seconds. Use 0 to wait indefinitely (the default behavior).
     */
    const TIMEOUT = 'timeout';

    private $repoName;
    private $call = true;
    private $secured = Config::SECURED;

    /**
     * Build a new Http Client
     * @param string $repoName  the specified repository name
     * @param boolean $call     whether the call is to do the HTTP request
     */
    public function __construct($repoName, $call = true) {
        $this->repoName = $repoName;
        $this->call = $call;
    }

    /**
     * Trigger a GET request
     * @return Response
     */
    public function get() {
        $result = $this->_call('GET', $this->buildURL(), '', Config::CONTENT_TYPE);
        return $result;
    }

    /**
     * Magic method to call a Travis Encrypter resource
     * @param string $method  http method
     * @param string $url     call url
     * @param array  $body    Mailjet resource body
     * @param string $type    Request Content-type
     * @return Response server response
     */
    private function _call($method, $url, $body, $type) {
        $url = $this->buildURL();
        $request = new Request($method, $url, $body, $type);
        return $request->call($this->call);
    }

    /**
     * Build the base API url depending on wether user need a secure connection
     * or not
     * @return string the API url;
     */
    private function getApiUrl() {
        return $this->secured ? 'https://'.Config::MAIN_URL:'http://'.Config::MAIN_URL;
    }

    /**
     * Build the final call url without query strings
     * @return string final call url
     */
    private function buildURL() {
        return $this->getApiUrl().'/repos/'.$this->repoName.'/key';
    }
}
