<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class TransactionController extends Controller
{
    public function index()
    {
        $member = session('member');
        if($member==null)
        {
            return redirect('/sign-in');
        }
        $inv = DB::table('investments')->where('member_id', $member->id)->first();
        if($inv==null)
        {
            return redirect('member/investment/'. Helper::encryptor("encrypt", $member->id));
        }
        
        // get all 5 transaction types into one and select top 100
        // 1. investment reward
        // 2. commission reward
        // 3. matching reward
        // 4. transfer transaction
        // 5. payment request transaction
        
        return view('fronts.members.transaction', $data);
    }
}
