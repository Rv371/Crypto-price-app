<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class KuCoinService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.kucoin.com',
            'timeout'  => 10.0,
        ]);
    }

    // Method to get the live price of a cryptocurrency
    public function getLivePrice($symbol)
    {
        try {
            // Make a GET request to KuCoin's API to get the live price of the given symbol (e.g., BTC-USDT)
            $response = $this->client->request('GET', "/api/v1/market/orderbook/level1", [
                'query' => ['symbol' => $symbol],
            ]);

            // Decode the response JSON data into an array
            $data = json_decode($response->getBody()->getContents(), true);

            // Return the price if available
            if (isset($data['data']['price'])) {
                return $data['data']['price'];
            } else {
                return null;
            }
        } catch (RequestException $e) {
            // Return null if there's an error (e.g., no internet, invalid response)
            return null;
        }
    }

    // Method to get prices for multiple cryptos
    public function getMultiplePrices($symbols = [])
    {
        $prices = [];
        foreach ($symbols as $symbol) {
            $prices[$symbol] = $this->getLivePrice($symbol);
        }
        return $prices;
    }
}
