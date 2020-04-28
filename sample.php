<?php

require __DIR__ . '/vendor/autoload.php';

use Changelly\Changelly;

// get your key and secret here https://changelly.com/developers#keys
$changelly = new Changelly('yourApiKey', 'yourApiSecret');

echo json_encode($changelly->getCurrenciesFull()) . PHP_EOL;

// Ensure that a basic conversion returns a value
echo json_encode($changelly->getExchangeAmount('btc', 'eth', 1)) . PHP_EOL;

// Throw an error, with a status code of 422, as the request cannot be processed
try {
    $changelly->getExchangeAmount('btc', 'eth', 22000000);
} catch (Exception $e) {
    echo $e->getCode() . PHP_EOL;
    echo $e->getMessage() . PHP_EOL;
}
