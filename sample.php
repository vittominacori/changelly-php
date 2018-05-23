<?php

require __DIR__ . '/vendor/autoload.php';

use Changelly\Changelly;

// get your key and secret here https://changelly.com/developers#keys
$changelly = new Changelly('yourApiKey', 'yourApiSecret');

echo json_encode($changelly->getCurrenciesFull());
