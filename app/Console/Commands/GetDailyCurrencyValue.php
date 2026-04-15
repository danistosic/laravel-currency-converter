<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\ExchangeRate;

class GetDailyCurrencyValue extends Command
{
    protected $signature = 'currency:get-values';
    protected $description = 'Get today currency values for USD and EUR';

    public function handle()
    {
        $currencies = ['usd', 'eur'];

        foreach ($currencies as $currency) {

            $response = Http::get("https://kurs.resenje.org/api/v1/currencies/{$currency}/rates/today");

            ExchangeRate::updateOrCreate(
                ['currency' => $currency],
                ['value' => $response->json()['exchange_middle']]
            );
        }

        $this->info('Values saved successfully!');
    }
}
