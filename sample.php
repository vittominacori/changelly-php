<?php

require __DIR__ . '/vendor/autoload.php';

use Changelly\Changelly;

// get your key and secret here https://changelly.com/developers#keys
$changelly = new Changelly('yourApiKey', 'yourApiSecret');

echo json_encode($changelly->getCurrenciesFull()) . PHP_EOL;

// Ensure that a basic conversion returns a value
echo json_encode($changelly->getExchangeAmount('btc', 'eth', 1)) . PHP_EOL;

// Return the error when changelly cannot process the request
echo json_encode($changelly->getExchangeAmount('btc', 'eth', 22000000)) . PHP_EOL;
