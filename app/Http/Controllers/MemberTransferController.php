<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class MemberTransferController extends Controller
{
    public function to_own_register_wallet()
    {
        $member = session('member');
        if($member==null)
        {
            return redirect('/sign-in');
        }
        $data['member'] = DB::table('members')->where('id', $member->id)->first();
        return view('fronts.members.transfer1', $data);
    }
    public function save_register_wallet(Request $r)
    {
        $member = session('member');
        if($member==null)
        {
            return redirect('/sign-in');
        }
        $m = DB::table('members')->where('id', $member->id)->first();
        $amount = $r->amount;
        // check if have enough balance or not
        if($amount>Helper::encryptor('decrypt', $m->cash_wallet))
        {
            $r->session()->flash('sms1', "You don't have enough fund to transfer!");
            return redirect('member/transfer/register');
        }

        // start transfer
        $rw = Helper::encryptor('decrypt', $m->register_wallet) + $amount;
        $cw = Helper::encryptor('decrypt', $m->cash_wallet) - $amount;

        $data = array(
            'cash_wallet' => $cw,
            'register_wallet' => $rw
        );
        DB::table('members')->where('id', $m->id)->update($data);
        // save transaction
        $data = array(
            'transaction_date' => date('Y-m-d'),
            'from_id' => $m->id,
            'to_id' => $m->id,
            'amount' => $amount,
            'account_name' => $m->username,
            'fee_charge' => 0,
            'note' => "transfer from your cash wallet to your own regsiter wallet",
            'to_wallet' => 'register wallet'
        );
        DB::table('member_transfer_transactions')->insert($data);
        $r->session()->flash('sms', "Your transaction has been completed!");
        return redirect('member/transfer/register');
    }
    // transfer to any wallet
    // public function to_any_wallet()
    // {
    //     $member = session('member');
    //     if($member==null)
    //     {
    //         return redirect('/sign-in');
    //     }
    //     $data['member'] = DB::table('members')->where('id', $member->id)->first();
    //     return view('fronts.members.transfer2', $data);
    // }
    // public function save_any_wallet(Request $r)
    // {
    //     $member = session('member');
    //     if($member==null)
    //     {
    //         return redirect('/sign-in');
    //     }
    //     $m = DB::table('members')->where('id', $member->id)->first();
    //     $amount = $r->amount;
    //     $account = $r->account;
    //     $pin = $r->pin;
    //     $fee = DB::table('transaction_fees')->where('id', 1)->first();

    //     // check if have enough balance or not
    //     if(($amount + $fee->fee)>$m->cash_wallet)
    //     {
    //         $r->session()->flash('sms1', "You don't have enough fund to transfer!");
    //         return redirect('member/transfer/anywallet');
    //     }
    //     if($pin!=$m->security_pin)
    //     {
    //         $r->session()->flash('sms1', "Invalid security PIN!");
    //         return redirect('member/transfer/anywallet');
    //     }
    //     $to_account = DB::table('members')->where('username', $account)->where('active', 1)->first();
    //     if($to_account==null)
    //     {
    //         $r->session()->flash('sms1', "The account name to transfer does not exist!");
    //         return redirect('member/transfer/anywallet');
    //     }
    //     // start transfer
    //     $data = array(
    //         'cash_wallet' => ($to_account->cash_wallet + $amount)
    //     );
    //     DB::table('members')->where('id', $to_account->id)->update($data);
    //     // cut money from sender, $m
    //     $data1 = array(
    //         'register_wallet' => $m->register_wallet - ($amount+$fee->fee)
    //     );
    //     DB::table('members')->where('id', $m->id)->update($data1);
    //     $ad = DB::table('admin_earning_fees')->sum('earning');
    //     $data2 = array(
    //         'earning' => $ad + $fee->fee
    //     );
    //     DB::table('admin_earning_fees')->where('id', 1)->update($data2);
    //     // save transfer transaction
    //     $data3 = array(
    //         'transaction_date' => date('Y-m-d'),
    //         'from_id' => $m->id,
    //         'to_id' => $to_account->id,
    //         'amount' => $amount,
    //         'account_name' => $account,
    //         'fee_charge' => $fee->fee,
    //         'note' => "transfer to other account",
    //         'to_wallet' => 'cash wallet'
    //     );
    //     DB::table('member_transfer_transactions')->insert($data3);
    //     $data4 = array(
    //         'transaction_date' => date('Y-m-d'),
    //         'amount' => $amount,
    //         'fee' => $fee->fee,
    //         'from_id' => $m->id,
    //         'to_id' => $to_account->id,
    //         'to_account' => $account,
    //         'note' => "fransfer to any account with transaction fee",
    //         'to_wallet' => 'cash wallet'
    //     );
    //     DB::table('admin_earning_fee_transactions')->insert($data4);
    //     $r->session()->flash('sms', "Transaction is completed!");
    //     return redirect('member/transfer/anywallet');
    // }
    public function to_any_register()
    {
        
        $member = session('member');
        if($member==null)
        {
            return redirect('/sign-in');
        }
        $data['member'] = DB::table('members')->where('id', $member->id)->first();
        return view('fronts.members.transfer3', $data);
    }
    public function save_register(Request $r)
    {
        $member = session('member');
        if($member==null)
        {
            return redirect('/sign-in');
        }
        $m = DB::table('members')->where('id', $member->id)->first();
        $amount = $r->amount;
        $account = $r->account;
        $pin = $r->pin;
        $fee = DB::table('transaction_fees')->where('id', 1)->first();
         // check if have enough balance or not
         if(($amount + $fee->fee)>Helper::encryptor('decrypt', $m->register_wallet))
         {
             $r->session()->flash('sms1', "You don't have enough fund to transfer!");
             return redirect('member/transfer/anyregister');
         }
         // check security pin
         if(!password_verify($pin, $m->security_pin))
         {
            $r->session()->flash('sms1', "Invalid security PIN!");
            return redirect('member/transfer/anyregister');
         }
        //  if($pin!=$m->security_pin)
        //  {
            
        //  }
         $to_account = DB::table('members')->where('username', $account)->where('active', 1)->first();
         if($to_account==null)
         {
             $r->session()->flash('sms1', "The account name to transfer does not exist!");
             return redirect('member/transfer/anyregister');
         }

        // start transfer
        $data = array(
            'register_wallet' => Helper::encryptor('encrypt', (Helper::encryptor('decrypt', $to_account->register_wallet) + $amount))
        );
        DB::table('members')->where('id', $to_account->id)->update($data);
        // cut money from sender, $m
        $data1 = array(
            'register_wallet' => Helper::encryptor('encrypt', Helper::encryptor('decrypt', $m->register_wallet) - ($amount+$fee->fee))
        );
        DB::table('members')->where('id', $m->id)->update($data1);
        if($fee->fee>0)
        {
            $ad = DB::table('admin_earning_fees')->sum('earning');
            $data2 = array(
                'earning' => $ad + $fee->fee
            );
            DB::table('admin_earning_fees')->where('id', 1)->update($data2);
            $data4 = array(
                'transaction_date' => date('Y-m-d'),
                'amount' => $amount,
                'fee' => $fee->fee,
                'from_id' => $m->id,
                'to_id' => $to_account->id,
                'to_account' => $account,
                'note' => "fransfer to any register wallet",
                'to_wallet' => 'register wallet'
            );
            DB::table('admin_earning_fee_transactions')->insert($data4);
        }
         // save transfer transaction
         $data3 = array(
            'transaction_date' => date('Y-m-d'),
            'from_id' => $m->id,
            'to_id' => $to_account->id,
            'amount' => $amount,
            'account_name' => $account,
            'fee_charge' => $fee->fee,
            'note' => "transfer to other  register account",
            'to_wallet' => 'register wallet'
        );
        DB::table('member_transfer_transactions')->insert($data3);
        $r->session()->flash('sms', "Transaction is completed!");
        return redirect('member/transfer/anyregister');
    }
    public function to_b_wallet()
    {
        $member = session('member');
        if($member==null)
        {
            return redirect('/sign-in');
        }
        $data['member'] = DB::table('members')->where('id', $member->id)->first();
        return view('fronts.members.transfer4', $data);
    }
    public function save_b_wallet(Request $r)
    {
        $member = session('member');
        if($member==null)
        {
            return redirect('/sign-in');
        }
        $m = DB::table('members')->where('id', $member->id)->first();
        $amount = $r->amount;
        // check if have enough balance or not
        if($amount>Helper::encryptor('decrypt', $m->cash_wallet))
        {
            $r->session()->flash('sms1', "You don't have enough fund to transfer!");
            return redirect('member/transfer/bwallet');
        }
        $data = array(
            'token_wallet' => Helper::encryptor('encrypt', Helper::encryptor('decrypt', $m->token_wallet) + $amount)
        );
        DB::table('members')->where('id', $m->id)->update($data);
        // cut money
        $data1 = array(
            'cash_wallet' => Helper::encryptor('encrypt', Helper::encryptor('decrypt', $m->cash_wallet) - $amount)
        );
        DB::table('members')->where('id', $m->id)->update($data1);
        // save transaction log
        $data2 = array(
            'transaction_date' => date('Y-m-d'),
            'from_id' => $m->id,
            'to_id' => $m->id,
            'amount' => $amount,
            'account_name' => $m->username,
            'fee_charge' => 0,
            'note' => "transfer to other  token wallet",
            'to_wallet' => 'register wallet'
        );
        DB::table('member_transfer_transactions')->insert($data2);
        $r->session()->flash('sms', 'Transaction is completed!');
        return redirect('member/transfer/bwallet');
    }
    public function to_anc()
    {
        $member = session('member');
        if($member==null)
        {
            return redirect('/sign-in');
        }
        $data['member'] = DB::table('members')->where('id', $member->id)->first();
        return view('fronts.members.transfer5', $data);
    }
    public function save_to_anc(Request $r)
    {
        $member = session('member');
        if($member==null)
        {
            return redirect('/sign-in');
        }
        $m = DB::table('members')->where('id', $member->id)->first();
        $amount = $r->amount;
        
    }
}
