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

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;

class Request extends GuzzleClient {

    private $method;
    private $body;
    private $url;
    private $type;

    /**
     * Build a new Http request
     * @param string $method  http method
     * @param string $url     call url
     * @param array  $body    Mailjet resource body
     * @param string $type    Request Content-type
     */
    public function __construct($method, $url, $body, $type = 'application/json') {
        parent::__construct([
            'defaults' => [
                'headers' => [
                    'user-agent' => Config::USER_AGENT.'/'.Config::WRAPPER_VERSION,
                    'Accept' => Config::CONTENT_TYPE,
                ]
            ]
        ]);
        $this->method = $method;
        $this->body = $body;
        $this->url = $url;
        $this->type = $type;
    }

     /**
     * Trigger the actual call
     * @param $call
     * @return Response the call response
     */
    public function call($call) {
        $payload = [
            'headers' => ['content-type' => $this->type],
        ];
        $response = null;
        if ($call) {
            try {
                $response = call_user_func_array(
                    [$this, strtolower($this->method)], [$this->url, $payload]
                );
            } catch (ClientException $e) {
                $response = $e->getResponse();
            } catch (ServerException $e) {
                $response = $e->getResponse();
            }
        }
        return new Response($this, $response);
    }

   /**
     * Http method getter
     * @return string Request method
     */
    public function getMethod() {
        return $this->method;
    }

    /**
     * Call Url getter
     * @return string Request Url
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     * Request body getter
     * @return array request body
     */
    public function getBody() {
        return $this->body;
    }
}
