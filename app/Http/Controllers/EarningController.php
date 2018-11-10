<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class EarningController extends Controller
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
        // calculate earning for the current month if not pay yet.
       // Investment::earning($member->id, date('Y-m-d'), $inv->package_id);
        
        // reward for the current month
        $m = date('m');
        $y = date('Y');

        $data['reward'] = DB::table('member_earning_transactions')
            ->where(DB::raw('month(transaction_date)'), $m)
            ->where(DB::raw('year(transaction_date)'), $y)
            ->sum('amount');
        $data['network'] = DB::table('network_earning_transactions')
            ->where(DB::raw('month(transaction_date)'), $m)
            ->where(DB::raw('year(transaction_date)'), $y)
            ->where('to_id', $member->id)
            ->sum('amount');
        $data['rate'] = DB::table('rates')->where('id', 1)->first();
        $data['wallet'] = DB::table('members')->where('id', $member->id)->first();
        $data['bonus'] = Investment::bonus($member->id);
        return view('fronts.members.earning', $data);
    }
}
