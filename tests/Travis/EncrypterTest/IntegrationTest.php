<?php

namespace Travis\EncrypterTest;

use Travis\Encrypter\Client;
use Travis\Encrypter\Encrypter;

class IntegrationTest extends \PHPUnit_Framework_TestCase
{
    public function testEncrypt()
    {
        $client = new Client('peter279k/php-travis-encrypter');
        $result = $client->get();
        $key = $result->getKey();
        $encrypter = new Encrypter($key, 'name', 'value');
        $this->assertSame('value', getenv('name'));
        $this->assertInternalType('string', $encrypter->encrypt());
    }
}
