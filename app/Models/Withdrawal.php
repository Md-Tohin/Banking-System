<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Deposit;
use Auth;

class Withdrawal extends Model
{
    use HasFactory;

    protected $guarded = [];

    //  get balance amount
    public static function getBalanceAmount(){
        $deposit_amount = Deposit::where('user_id', Auth::user()->id)->sum('amount');
        $withdrawal_amount = Withdrawal::where('user_id', Auth::user()->id)->sum('grand_total');
        $balance_amount = $deposit_amount - $withdrawal_amount;
        return $balance_amount; 
    }

}
