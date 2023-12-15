<?php

namespace Bankys;

use GuzzleHttp\Client as GuzzleHttpClient;

class Client extends GuzzleHttpClient
{
    public function __construct()
    {
        parent::__construct([
            'base_uri' => 'https://bankys.acessarminhaconta.com/api/'
        ]);
    }
}
