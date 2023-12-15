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

$extract = $bankys->getExtract(
    '2023-12-01',
    '2023-12-31'
);

var_dump($extract);
