<?php

use GuzzleHttp\Client;

require __DIR__.'/vendor/autoload.php';

$client = new Client([
    'base_uri' => 'http://localhost:9008'
]);

$response = $client->get('/api/products');

dump((string) $response->getBody());
dump($response->getStatusCode());