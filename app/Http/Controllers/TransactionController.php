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
            return redirect('member/investment/'. $member->id);
        }
        $id = $member->id;
        // get all 5 transaction types into one and select top 100
        // 1. investment reward
        // 2. commission reward
        // 3. matching reward
        // 4. transfer transaction
        // 5. payment request transaction
        $sql = "
            (select amount, 'Cash Out' as description, create_at, status from payment_requests where member_id = {$id} ORDER BY create_at DESC limit 25 )
            UNION ALL
            (select amount, 'Transfer' as description, create_at, 1 as status from member_transfer_transactions WHERE from_id = {$id} order by create_at desc limit 15)
            UNION ALL 
            (select amount, 'Receive' as description, create_at, 1 as status from member_transfer_transactions where to_id = {$id} order by create_at desc limit 15)
            UNION ALL
            (select amount, 'Investment Reward' as description, create_at, 1 as status from member_earning_transactions	where member_id = {$id} order by create_at DESC limit 25)
            UNION ALL
            (select amount, 'Commission Reward' as description, create_at, 1 as status from network_earning_transactions where to_id= {$id} order by create_at DESC limit 25)
            UNION ALL
            (select amount, 'Matching Reward' as description, create_at, 1 as status from bonus_earning_transactions where member_id = {$id} ORDER by create_at DESC limit 25)
            order by create_at DESC
            ";
        $data['trans'] = DB::select($sql);
        return view('fronts.members.transaction', $data);
    }
}
