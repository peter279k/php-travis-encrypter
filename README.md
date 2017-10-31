# php-travis-encrypter

[![StyleCI](https://styleci.io/repos/109020662/shield?branch=master)](https://styleci.io/repos/109020662)
[![Coverage Status](https://coveralls.io/repos/github/peter279k/php-travis-encrypter/badge.svg?branch=master)](https://coveralls.io/github/peter279k/php-travis-encrypter?branch=master)
[![Build Status](https://travis-ci.org/peter279k/php-travis-encrypter.svg?branch=master)](https://travis-ci.org/peter279k/php-travis-encrypter)

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

## Contributing

I appreciate the contribution.Here is the tips for contributing project.

- coding style: psr-2 (check coding style via StyleCI)
- add the some featues should add the mapped unit testing.
