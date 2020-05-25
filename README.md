# Romania Personal Identification Number(in Romanian CNP) validator

## Install

`composer require robertpatan/php-cnp-validator`

## Usage

```
require_once __DIR__ . '/vendor/autoload.php';
//example 1
\Src\CnpValidator::validate('3900527016311');

//example 2
$validator = new \Src\CnpValidator('3900527016311');
$validator->isValid();
```


## Tests

run tests: `./vendor/bin/phpunit --bootstrap ./vendor/autoload.php`
