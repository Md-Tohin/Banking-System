<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Auth;

class WithdrawalController extends Controller
{
    //  index
    public function index()
    {
        $all_data = Withdrawal::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        return view('backend.withdrawal.index', compact('all_data'));
    }

    //  create
    public function create()
    {
        $currentMonth = Carbon::now()->format('F');
        $currentYear = Carbon::now()->year;

        $countWithdrawal = Withdrawal::where('user_id', Auth::user()->id)->where('year',$currentYear)->where('month', $currentMonth)->count();
        $today_withdrawal_amount = Withdrawal::where('user_id', Auth::user()->id)->where('date',Carbon::now()->format('d F Y'))->sum('amount');
        $balance_amount = Withdrawal::getBalanceAmount();

        if ($countWithdrawal > 3) {
            $vat_amount = 5;
        }
        else{
            $vat_amount = 0;
        }
        return view('backend.withdrawal.create', compact('vat_amount', 'today_withdrawal_amount', 'balance_amount'));
    }

    //  store
    public function store(Request $request)
    {
        $today_withdrawal_amount = Withdrawal::where('date',Carbon::now()->format('d F Y'))->sum('amount');
        if (($today_withdrawal_amount + $request->amount) > 3000) {
            return redirect()->back()->with('error', 'You can not withdraw more than 3000');
        }
        $balance_amount = Withdrawal::getBalanceAmount();
        if ($balance_amount < $request->amount) {
            return redirect()->back()->with('error', 'You can not withdraw more than your balance amount');
        }
        $request->validate([
            'wd_number' => 'required',
            'amount' => 'required|numeric|min:1',
        ],[
            'wd_number.required' => 'Withdrawal number field is required',
            'amount.required' => 'Amount field is required',
            'amount.min' => 'Amount minimum value is 1',
        ]);
        
        $withdrawal = new Withdrawal();
        $withdrawal->user_id = Auth::user()->id;
        $withdrawal->wd_number = $request->wd_number;
        $withdrawal->amount = $request->amount;
        $withdrawal->vat = $request->vat;
        $withdrawal->vat_amount = $request->vat_amount;
        $withdrawal->grand_total = $request->grand_total;
        $withdrawal->description = $request->description;
        $withdrawal->date = Carbon::now()->format('d F Y');
        $withdrawal->month = Carbon::now()->format('F');
        $withdrawal->year = Carbon::now()->format('Y');
        $withdrawal->status = 1;
        $withdrawal->created_at = Carbon::now();
        $withdrawal->save();

        return redirect()->route('withdrawal.list')->with('message','Withdrawal Successfully Done!');
    }

}
