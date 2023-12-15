<?php

use Bankys\Bankys;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/vars.php';

$bankys = new Bankys(
    $authUsername,
    $authPassword,
    $clientId,
    $clientSecret,
    $token
);

$pixKey = $bankys->getPixKey('your-pix-key');

var_dump($pixKey);
