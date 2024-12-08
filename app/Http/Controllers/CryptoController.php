<?php

namespace App\Http\Controllers;

use App\Services\KuCoinService;
use Illuminate\Http\Request;

class CryptoController extends Controller
{
    protected $kuCoinService;

    public function __construct(KuCoinService $kuCoinService)
    {
        $this->kuCoinService = $kuCoinService;
    }

    public function index()
    {
        // List of popular cryptocurrency symbols (pairs) to show in the table
        $symbols = ['BTC-USDT', 'ETH-USDT', 'XRP-USDT', 'ADA-USDT', 'DOGE-USDT'];

        // Get the live prices for the selected cryptocurrencies
        $prices = $this->kuCoinService->getMultiplePrices($symbols);

        // Pass the prices to the view
        return view('crypto.index', ['prices' => $prices]);
    }
    public function getLivePrice(Request $request)
{
    $symbol = strtoupper($request->symbol);  // Ensure uppercase symbols
    $price = $this->kuCoinService->getLivePrice($symbol);

    if ($price) {
        return response()->json(['price' => $price]);
    } else {
        return response()->json(['error' => 'Price not found'], 404);
    }
}

}
