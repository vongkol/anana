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
        // withdraw days
        $days = config('app.days');

        $m = DB::table('members')->where('id', $member->id)->first();
        $amount = $r->amount;
        $pin = $r->pin;
        if($amount>Helper::encryptor('decrypt', $m->cash_wallet))
        {
            $r->session()->flash('sms1', "You don't have enough balance!");
            return redirect('member/payment');
        }
        // check security pin
        if(!password_verify($pin, $m->security_pin))
        {
            $r->session()->flash('sms1', "Invalid security PIN!");
            return redirect('member/payment');
        }
        // check threshold
        $th = DB::table('thresholds')->where('id', 1)->first();
        if($amount<$th->value)
        {
            $r->session()->flash('sms1', "You need to withdraw at least $ {$th->value}");
            return redirect('member/payment');
        }
        // check withdraw date
        $day = date('d');
        if($day!=$days[0] || $day!=$days[1] || $day!=$days[2])
        {
            $r->session()->flash('sms1', "You can withdraw only on day {$days[0]} or {$days[1]} or {$days[2]} of the month!");
            return redirect('member/payment');
        }
        // send request
        $data = array(
            'member_id' => $m->id,
            'amount' => $amount,
            'request_date' => date('Y-m-d')
        );
        DB::table('payment_requests')->insert($data);
        $cw = Helper::encryptor('decrypt', $m->cash_wallet) - $amount;
        DB::table('members')->where('id', $m->id)->update(['cash_wallet'=>Helper::encryptor('encrypt', $cw)]);
        $r->session()->flash('sms', "Your request has sent!");
        return redirect('member/payment');
    }
}
