<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ExchangeRateRepository;

class CurrencyController extends Controller
{
    protected $rates;

    public function __construct(ExchangeRateRepository $rates)
    {
        $this->rates = $rates;
    }

    public function showForm()
    {
        return view('convert');
    }

    public function convert(Request $request)
    {
        $amount = $request->amount;
        $direction = $request->direction;

        // dohvat iz baze
        $eur = $this->rates->getRate('eur');
        $usd = $this->rates->getRate('usd');

        if ($direction === 'eur_usd') {
            $result = $amount * ($usd / $eur);
            $text = number_format($result, 2) . ' USD';
        } else {
            $result = $amount * ($eur / $usd);
            $text = number_format($result, 2) . ' EUR';
        }

        return view('convert', ['result' => $text]);
    }
}
