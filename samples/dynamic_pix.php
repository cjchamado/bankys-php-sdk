<?php
// 

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

$pix = $bankys->dynamicPix(
    $pixKey,
    'Compra de algo teste',
    7.00
);

var_dump($pix);
