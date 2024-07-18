# php-vendor-creadits

php-vendor-creadits creates CREDITS file from LICENSE files of dependencies

![Testing](https://github.com/smeghead/php-vendor-credits/actions/workflows/php.yml/badge.svg?event=push) [![Latest Stable Version](https://poser.pugx.org/smeghead/php-vendor-credits/v)](https://packagist.org/packages/smeghead/php-vendor-credits) [![Total Downloads](https://poser.pugx.org/smeghead/php-vendor-credits/downloads)](https://packagist.org/packages/smeghead/php-vendor-credits) [![Latest Unstable Version](https://poser.pugx.org/smeghead/php-vendor-credits/v/unstable)](https://packagist.org/packages/smeghead/php-vendor-credits) [![License](https://poser.pugx.org/smeghead/php-vendor-credits/license)](https://packagist.org/packages/smeghead/php-vendor-credits) [![PHP Version Require](https://poser.pugx.org/smeghead/php-vendor-credits/require/php)](https://packagist.org/packages/smeghead/php-vendor-credits)

php-vendor-creadits was created as a PHP Composer version of gocredits (https://github.com/Songmu/gocredits).

## Install

### From Composer

```bash
$ composer require --dev smeghead/php-vendor-credits
```

## Usage

```bash
$ vendor/bin/php-vendor-credits . > CREDITS
```

## Development

```bash
$ docker compose build
$ docker compose run --rm php_cli bash
```
