<?php
/**
 * Changelly PHP
 *
 * @link      https://github.com/vittominacori/changelly-php
 * @author    Vittorio Minacori (https://github.com/vittominacori)
 * @license   https://github.com/vittominacori/changelly-php/blob/master/LICENSE (MIT License)
 */
namespace Changelly;

use Unirest;

/**
 * Class Market
 * @package Changelly
 */
class Changelly
{
    private static $endpoint = 'https://api.changelly.com';
    private static $apiKey = '';
    private static $apiSecret = '';

    /**
     * Changelly constructor.
     * @param string $apiKey
     * @param string $apiSecret
     * @throws \Exception
     */
    public function __construct($apiKey, $apiSecret)
    {
        if (empty($apiKey) || empty($apiSecret)) {
            throw new Exception('Invalid api key or secret');
        }
        self::$apiKey = $apiKey;
        self::$apiSecret = $apiSecret;
    }

    // public methods

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getCurrencies()
    {
        return $this->post('getCurrencies');
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getCurrenciesFull()
    {
        return $this->post('getCurrenciesFull');
    }

    /**
     * @param string $from
     * @param string $to
     * @return mixed
     * @throws \Exception
     */
    public function getMinAmount($from, $to)
    {
        return $this->post('getMinAmount', ['from' => $from, 'to' => $to]);
    }

    /**
     * @param string $from
     * @param string $to
     * @param $amount
     * @return mixed
     * @throws \Exception
     */
    public function getExchangeAmount($from, $to, $amount)
    {
        return $this->post('getExchangeAmount', ['from' => $from, 'to' => $to, 'amount' => $amount]);
    }

    /**
     * @param string $from
     * @param string $to
     * @param string $payoutAddress
     * @return mixed
     * @throws \Exception
     */
    public function createTransaction($from, $to, $payoutAddress, $amount)
    {
        return $this->post('createTransaction', [
            'from' => $from,
            'to' => $to,
            'address' => $payoutAddress,
            'amount' => $amount
        ]);
    }

    /**
     * @param string $transactionId
     * @return mixed
     * @throws \Exception
     */
    public function getStatus($transactionId)
    {
        return $this->post('getStatus', ['id' => $transactionId]);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getTransactions()
    {
        return $this->post('getTransactions');
    }

    // private methods

    /**
     * @param string $method
     * @param array $params
     * @return mixed
     * @throws \Exception
     */
    private function post($method, $params = [])
    {
        $message = Unirest\Request\Body::json(
            [
                "jsonrpc" => "2.0",
                "id" => 1,
                "method" => $method,
                "params" => $params
            ]
        );
        $sign = hash_hmac('sha512', $message, self::$apiSecret);
        $headers = [
            'api-key' => self::$apiKey,
            'sign' => $sign,
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ];
        $response = Unirest\Request::post(self::$endpoint, $headers, $message);
        if ($response->code == 200) {
            $body = $response->body;

            if (isset($body->result)) {
              return $body->result;
            }

            throw new \Exception(json_encode($body->error), 422);
        } else {
            throw new \Exception($response->body, $response->code);
        }
    }
}
