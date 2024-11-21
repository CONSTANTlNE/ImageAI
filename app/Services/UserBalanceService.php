<?php

namespace App\Services;

use App\Models\UserBalance;
use Illuminate\Support\Facades\Log;

class UserBalanceService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {

    }


    public function deductBalance(string $modelname,string $modelid,float $price,float $user=null){
        $model=$modelname.'_id';
        $userbalance=new UserBalance();
        $userbalance->user_id=$user;
        $userbalance->model=$modelname;
        $userbalance->$model=$modelid;
        $userbalance->balance=-$price;
        $userbalance->save();
    }

    public function checkBalance(string $modelname){
        $balance = round(Userbalance::sum('balance'), 2, PHP_ROUND_HALF_DOWN);
        $cost = config('variables.'.$modelname.'-price');
        if($balance > $cost){
            return true;
        }else{
            return false;
        }
    }
}
