<?php

namespace App\Services;

use App\Models\UserBalance;

class UserBalanceService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {

    }


    public function deductBalance(string $modelname,string $modelid,float $price){
        $model=$modelname.'_id';
        $userbalance=new UserBalance();
        $userbalance->model=$modelname;
        $userbalance->$model=$modelid;
        $userbalance->balance=-$price;
        $userbalance->save();
    }

    public function checkBalance(string $modelname){

        $balance = Userbalance::sum('balance');
        $cost = config('variables.'.$modelname.'-price');

        if($balance > $cost){
            return true;
        }else{
            return false;
        }
    }
}
