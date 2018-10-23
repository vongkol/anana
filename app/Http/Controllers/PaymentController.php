<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class PaymentController extends Controller
{
    public function index()
    {
        $member = session('member');
        if($member==null)
        {
            return redirect('/sign-in');
        }
        $data['member'] = DB::table('members')->where('id', $member->id)->first();
        return view('fronts.members.payment', $data);
    }
    public function save(Request $r)
    {
        $member = session('member');
        if($member==null)
        {
            return redirect('/sign-in');
        }
        $m = DB::table('members')->where('id', $member->id)->first();
        $amount = $r->amount;
        $pin = $r->pin;
        if($amount>$m->cash_wallet)
        {
            $r->session()->flash('sms1', "You don't have enough balance!");
            return redirect('member/payment');
        }
        if($pin!=$m->security_pin)
        {
            $r->session()->flash('sms1', "Invalid security PIN!");
            return redirect('member/payment');
        }
        // send request
        $data = array(
            'member_id' => $m->id,
            'amount' => $amount,
            'request_date' => date('Y-m-d')
        );
        DB::table('payment_requests')->insert($data);
        $cw = $m->cash_wallet - $amount;
        DB::table('members')->where('id', $m->id)->update(['cash_wallet'=>$cw]);
        $r->session()->flash('sms', "Your request has sent!");
        return redirect('member/payment');
    }
}
