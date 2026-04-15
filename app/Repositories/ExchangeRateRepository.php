<?php

namespace App\Repositories;

use App\Models\ExchangeRate;
use Illuminate\Support\Facades\Cache;

class ExchangeRateRepository
{
    public function getRate(string $currency)
    {
        return Cache::remember("rate_{$currency}", 300, function () use ($currency) {
            return ExchangeRate::where('currency', $currency)->value('value');
        });
    }
}
