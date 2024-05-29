<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deposit;
use App\Models\Withdrawal;
use Carbon\Carbon;
use Auth;

class DashboardController extends Controller
{
    //  dashboard
    public function dashboard()
    {
        $data['balance_amount'] = Withdrawal::getBalanceAmount();
        $data['total_deposit_amount'] = Deposit::where('user_id', Auth::user()->id)->sum('amount');
        $data['total_withdrawal_amount'] = Withdrawal::where('user_id', Auth::user()->id)->sum('amount');
        $data['total_vat_amount'] = Withdrawal::where('user_id', Auth::user()->id)->sum('vat_amount');
        $data['current_month_deposit_amount'] = Deposit::where('user_id', Auth::user()->id)->where('year', Carbon::now()->year)->where('month', Carbon::now()->format('F'))->sum('amount');
        $data['current_month_withdrawal_amount'] = Withdrawal::where('user_id', Auth::user()->id)->where('year', Carbon::now()->year)->where('month', Carbon::now()->format('F'))->sum('amount');
        return view('backend.dashboard', $data);
    }
}
