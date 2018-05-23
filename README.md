# Changelly for PHP

A PHP wrapper for [Changelly](https://api-docs.changelly.com/) APIs

## Install

```
composer require vittominacori/changelly-php
```

## Generate Api Key and Secret

Generate Key and Secret [here](https://changelly.com/developers#keys).


## Usage

### Prepare requirements

```php
require __DIR__ . '/vendor/autoload.php';

use Changelly\Changelly;
```

### Create client

```php
$changelly = new Changelly('yourApiKey', 'yourApiSecret');
```

### Call APIs


#### getCurrencies

Description:
+ Returns a list of enabled currencies as a flat array.

```php
$changelly->getCurrencies();
```

result: 

```json
[
  "btc",
  "eth",
  "etc",
  "exp",
  "xem",
  "lsk",
  "xmr",
  "strat",
  "rep",
  "lbc",
  "maid",
  "ltc",
  "bcn",
  "xrp",
  "doge",
  "amp",
  "nxt",
  "dash",
  "xdn",
  "nbt",
  "nav",
  "pot",
  "gnt",
  "waves",
  "usdt",
  "swt",
  "mln",
  "pivx",
  "trst",
  "edg",
  "rlc",
  "gno",
  "dcr",
  "gup",
  "lun",
  "str",
  "bat",
  "ant",
  "bnt",
  "cvc",
  "eos",
  "pay",
  "bch",
  "omg",
  "mco",
  "adx",
  "zrx",
  "qtum",
  "ptoy",
  "storj",
  "cfi",
  "hmq",
  "nmr",
  "salt",
  "btg",
  "dgb",
  "dnt",
  "vib",
  "rcn",
  "zcl",
  "stx",
  "kmd",
  "brd",
  "dcn",
  "ngc",
  "xmo",
  "noah",
  "zen"
]
```


#### getCurrenciesFull

Description:
+ Returns a full list of currencies as an array of objects. Each object has an "enabled" field displaying current availability of a coin.

```php
$changelly->getCurrenciesFull();
```

result: 

```json
[
  {
    "name": "btc",
    "fullName": "Bitcoin",
    "enabled": true,
    "image": "https://changelly.com/coins/btc.svg"
  },
  {
    "name": "eth",
    "fullName": "Ethereum",
    "enabled": true,
    "image": "https://changelly.com/coins/eth.svg"
  },
  {
    "name": "etc",
    "fullName": "Ethereum Classic",
    "enabled": true,
    "image": "https://changelly.com/coins/etc.svg"
  },
  (...)
  {
    "name": "zen",
    "fullName": "Zencash",
    "enabled": true,
    "image": "https://changelly.com/coins/zen.svg"
  }
]
```


#### getMinAmount

Description:
+ Returns a minimum allowed payin amount required for a currency pair. Amounts less than a minimal will most likely fail the transaction.

```php
$changelly->getMinAmount('btc', 'eth');
```

result: 

```json
"0.00150457"
```


#### getExchangeAmount

Description:
+ Returns estimated exchange value with your API partner fee included.

```php
$changelly->getExchangeAmount('btc', 'eth', '1');
```

result: 

```json
"12.10716"
```


#### createTransaction

Description:
+ Creates a new transaction, generates a pay-in address and returns Transaction object with an ID field to track a transaction status.

```php
$changelly->createTransaction('btc', 'eth', '0x123123...123', 0.3);
```

result: 

```json
{
  "id": "854e8d7dc9ef",
  "apiExtraFee": "0",
  "changellyFee": "0.5",
  "payinExtraId": null,
  "status": "new",
  "currencyFrom": "btc",
  "currencyTo": "eth",
  "amountTo": 0,
  "payinAddress": "36P9TNYPbZrGs8Udn84F9uAY95VYM2Xk4K",
  "payoutAddress": "0x123123...123",
  "createdAt": "2018-05-04T15:15:02.000Z"
}
```


#### getStatus

Description:
+ Returns status of a given transaction using a transaction ID provided.

```php
$changelly->getStatus('854e8d7dc9ef');
```

result: 

```json
"waiting"
```


#### getTransactions

Description:
+ Returns an array of all transactions or a filtered list of transactions.

```php
$changelly->getTransactions();
```

result: 

```json
[
  {
    "id": "854e8d7dc9ef",
    "createdAt": 1525446902,
    "payinConfirmations": "0",
    "status": "waiting",
    "currencyFrom": "btc",
    "currencyTo": "eth",
    "payinAddress": "36P9TNYPbZrGs8Udn84F9uAY95VYM2Xk4K",
    "payinExtraId": null,
    "payinHash": null,
    "payoutAddress": "0x123123...123",
    "payoutExtraId": null,
    "payoutHash": null,
    "amountFrom": "",
    "amountTo": "0",
    "networkFee": null,
    "changellyFee": "0.5",
    "apiExtraFee": "0"
  },
  (...)
]
```
