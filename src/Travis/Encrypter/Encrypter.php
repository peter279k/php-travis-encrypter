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

use phpseclib\Crypt\RSA;

class Encrypter
{
    private $key;
    private $envName;
    private $envValue;

    /**
     * Construct a Travis Encrypter class
     * @param string $envName  actual environment name
     * @param string $envValue actual environment value
     */
    public function __construct($key, $envName, $envValue)
    {
        $this->key = $key;
        $this->envName = $envName;
        $this->envValue = $envValue;
    }

    /**
     * Encrypt the environment variable is by the Travis Encrypter class
     * @param string $envName  actual environment name
     * @param string $envValue actual environment value
     * @return string $result
     */
    public function encrypt()
    {
        //openssl_public_encrypt($this->envName.'='.$this->envValue, $result, $this->key);
        $rsa = new RSA();
        $rsa->loadKey($this->key);
        $result = $rsa->sign($this->envName.'='.$this->envValue);

        return base64_encode($result);
    }
}
