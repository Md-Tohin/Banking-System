<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Deposit;
use Illuminate\Http\Request;
use Auth;
use Validator;

class DepositController extends Controller
{
    //  list
    public function index()
    {
        $data['all_data'] = Deposit::orderBy('id', 'desc')->get();
        return view('backend.deposit.index', $data);
    }

    //  store
    public function store(Request $request)
    {
        if($request->ajax()){
            $validator = Validator::make($request->all(),[
                'deposit_number' =>'required|max:100',
                'amount' =>'required|numeric',
            ]);
            if($validator->passes()){               
                Deposit::create([
                    'user_id' => Auth::user()->id, 
                    'deposit_number' => $request->deposit_number, 
                    'amount' => $request->amount, 
                    'date' => Carbon::now()->format('d F Y'), 
                    'month' => Carbon::now()->format('F'), 
                    'year' => Carbon::now()->format('Y'), 
                    'description' => $request->description, 
                    'status' => 1,
                    'created_at' => Carbon::now(),
                ]);
                return response()->json([
                    'status' => 200,
                    'message' => 'Deposit Successfully Done!',
                ]); 
            }
            else{
                return response()->json(['status'=> 500, 'errors'=>$validator->messages()]);
            }             
        } 
    }

}
