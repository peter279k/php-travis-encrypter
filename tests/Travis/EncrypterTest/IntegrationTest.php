<?php

namespace Travis\EncrypterTest;

use Travis\Encrypter\Client;
use Travis\Encrypter\Encrypter;
use Travis\Encrypter\Request;
use Travis\Encrypter\Response;

class IntegrationTest extends \PHPUnit_Framework_TestCase
{
    protected $client;
    protected $errorClient;
    protected $repoName = 'peter279k/php-travis-encrypter';
    protected $request;
    protected $result;
    protected $errResult;

    protected function setUp()
    {
        $this->client = new Client($this->repoName);
        $this->errorClient = new Client('peter279k/123');
        $this->request =  new Request('GET', 'https://api.travis-ci.org/repos/'.$this->repoName.'/key', '', 'application/json');
        $this->result = $this->client->get();
        $this->errResult = $this->errorClient->get();
    }

    public function testEncrypt()
    {
        $encrypter = new Encrypter($this->result->getKey(), 'name', 'value');
        $this->assertInternalType('string', $this->result->getKey());
        $this->assertInternalType('string', $encrypter->encrypt());
    }

    public function testGetMethod()
    {
        $this->assertSame('GET', $this->request->getMethod());
    }

    public function testGetUrl()
    {
        $this->assertSame('https://api.travis-ci.org/repos/'.$this->repoName.'/key', $this->request->getUrl());
    }

    public function testGetRequestBody()
    {
        $this->assertSame('', $this->request->getBody());
    }

    public function testGetStatus()
    {
        $this->assertSame(200, $this->result->getStatus());
    }

    public function testGetResponseBody()
    {
        $this->assertInternalType('string', $this->result->getBody()['key']);
        $this->assertInternalType('string', $this->result->getBody()['fingerprint']);
    }

    public function testGetNoKey()
    {
        $this->assertSame('not found', $this->errResult->getKey()['file']);
    }

    public function testGetFile()
    {
        $this->assertSame('not found', $this->errResult->getFile());
    }

    public function testGetNoFile()
    {
        $this->assertInternalType('string', $this->result->getFile()['key']);
        $this->assertInternalType('string', $this->result->getFile()['fingerprint']);
    }

    public function testSuccess()
    {
        $this->assertTrue($this->result->success());
    }

    public function testGetFingerPrint()
    {
        $this->assertInternalType('string', $this->result->getFingerPrint());
    }

    public function testGetNoFingerPrint()
    {
        $this->assertSame('not found', $this->errResult->getFingerPrint()['file']);
    }
}
