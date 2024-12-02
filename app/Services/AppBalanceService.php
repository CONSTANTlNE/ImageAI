<?php

namespace App\Services;

use App\Models\Balance;
use Illuminate\Database\Eloquent\Model;

class AppBalanceService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function appBalance(string $provider, string $modelname)
    {
        $rate = Balance::where('provider', $provider)
            ->whereNotNull('rate')
            ->orderBy('created_at', 'desc')
            ->first();

        $balance           = new Balance;
        $balance->user_id  = auth()->id();
        $balance->provider = $provider;
        $balance->balance  = -config('variables.'.$modelname.'-cost');
        if ($rate) {
            $pricegel          = config('variables.'.$modelname.'-cost') * $rate->rate;
            $balance->cost_gel = $pricegel;
            $balance->profit = config('variables.'.$modelname.'-price') - $pricegel;
        }
        $balance->sell   = config('variables.'.$modelname.'-price');
        $balance->save();
    }
}
