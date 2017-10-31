# php-travis-encrypter

## Introduction

The PHP API wrapper is to encrypt the travis-ci environment variables.

## Usage

- Install the php-travis-encrypter via Composer.

```
composer require lee/php-travis-encrypter
```

- The sample code is as follows.

```php
$client = new Client('peter279k/php-travis-encrypter');
$result = $client->get();
$key = $result->getKey();
$encrypter = new Encrypter($key, 'name', 'value');
echo $encrypter->encrypt();
```

## Unit testing

- The project uses the PHPUnit to test the whole source code.

- Just clone this repo and run the following two commands:

```
composer install
phpunit
```
