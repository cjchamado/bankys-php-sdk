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

$transaction = $bankys->getTransaction('transaction-id');

echo(json_encode($transaction));

var_dump($transaction);
