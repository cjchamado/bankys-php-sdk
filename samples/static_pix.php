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

$pix1 = $bankys->staticPix(
    $pixKey,
    'Compra de algo teste',
    // 7.00 without value
);

var_dump($pix1);

$pix2 = $bankys->staticPix(
  $pixKey,
  'Compra de algo teste',
  7.00 // with value
);

var_dump($pix2);
