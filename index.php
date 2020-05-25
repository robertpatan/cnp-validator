<?php

require_once __DIR__ . '/vendor/autoload.php';

//$validator = new \Src\CnpValidator('0000000000000');
//$validator = new \Src\CnpValidator('0900322450044');
//$validator = new \Src\CnpValidator('0000000000000');

//var_dump($validator->isValid());

var_dump(\Src\CnpValidator::validate('3900527016311'));
//var_dump(\Src\CnpValidator::validate('2900517016311'));
