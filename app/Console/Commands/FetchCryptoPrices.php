<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Events\CryptoPriceUpdated;
use Illuminate\Support\Facades\Http;

class FetchCryptoPrices extends Command
{
    protected $signature = 'crypto:fetch-prices';
    protected $description = 'Fetch real-time crypto prices';

    public function handle()
    {
        $response = Http::get('https://api.coingecko.com/api/v3/simple/price?ids=bitcoin,ethereum&vs_currencies=usd');

        if ($response->successful()) {
            $prices = $response->json();
            broadcast(new CryptoPriceUpdated($prices));
            $this->info('Prices updated.');
        }
    }
}
