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
        $data['payments'] = DB::table('payment_requests')
            ->where('member_id', $member->id)
            ->orderBy('id', 'desc')
            ->get();
        $data['trans'] = DB::table('member_transfer_transactions')
            ->where('from_id', $member->id)
            ->orderBy('id', 'desc')
            ->get();
        $data['trans1'] = DB::table('member_transfer_transactions')
            ->where('to_id', $member->id)
            ->orderBy('id', 'desc')
            ->get();
        return view('fronts.members.transaction', $data);
    }
}
