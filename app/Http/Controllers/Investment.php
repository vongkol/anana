<?php

namespace App\Http\Controllers;
use DB;
use Auth;

class Investment
{
    public static function generate_schedule($pid)
    {
        $p = DB::table('investments')->where('id', $pid)->first();
        $package = DB::table('packages')->where('id', $p->package_id)->first();
        $member = DB::table('members')->where('id', $p->member_id)->first();
        $inv = DB::table('investments')->where('id', $pid)->first();
        $price = $package->price;
        $rate = $package->monthly_payout / 100;
        $amount = $price*$rate;
        $sdate = date('Y-m-d');
        $month = $package->duration / 30;
        for($i=1;$i<=$month;$i++)
        {
            $edate = date('Y-m-d', strtotime($sdate . "+ 30 day"));
            $pay_date = date('Y-m-d', strtotime($edate . "+ 1 day"));
            $data = array(
                'member_id' => $p->member_id,
                'package_id' => $p->package_id,
                'start_date' => $sdate,
                'end_date' => $edate,
                'pay_date' => $pay_date,
                'amount' => $amount,
                'month' => $i
            );
            DB::table('payment_schedules')->insert($data);
            $sdate = date('Y-m-d', strtotime($edate . " + 1 day"));
        }
    }

    public static function network_earning($mid, $pid)
    {
        // wallet rate
        $wallet_rate = DB::table('wallet_rates')->where('id', 1)->first();

        // $mid is the package buyer, $pid is the package
        $m = DB::table('members')->where('id', $mid)->first();
        $p = DB::table('packages')->where('id', $pid)->first();

        // the rate of sponsor package, not the buy package
        // sponsor_earning = sponsor_package_rate * buyer_investment
        $rate1 = 0;
        $rate2 = 0;
        $rate3 = 0;
        $rate4 = 0;
        $rate5 = 0;
        $rate6 = 0;
        // first gen
        $gen1 = DB::table('members')->where('username', $m->sponsor_id)->first();
        if($gen1!=null)
        {
            // package of the gen1 sponsor
            $p1 = DB::table('investments')
                ->join('packages', 'investments.package_id', 'packages.id')
                ->where('investments.member_id', $gen1->id)
                ->select('packages.*')
                ->first();
            if($p1!=null)
            {
                $rate1 = $p1->gen1;
            }
            // he has first gen
            if($rate1>0)
            {
                
                $r1 = $rate1/100;
                $earn1 = $p->price * $r1;
                // spit to c_wallet, r_wallet and b_wallet
                $c_wallet = $earn1*$wallet_rate->c_wallet;
                $r_wallet = $earn1*$wallet_rate->r_wallet;
                $b_wallet = $earn1*$wallet_rate->b_wallet;
                $admin_fee = $earn1*$wallet_rate->admin_fee;
                $wallet = array(
                    'cash_wallet' => Helper::encryptor('encrypt', Helper::encryptor('decrypt', $gen1->cash_wallet) + $c_wallet),
                    'register_wallet' => Helper::encryptor('encrypt', Helper::encryptor('decrypt', $gen1->register_wallet) + $r_wallet),
                    'token_wallet' => Helper::encryptor('encrypt', Helper::encryptor('decrypt', $gen1->token_wallet))
                );            
                DB::table('members')->where('id', $gen1->id)->update($wallet);
                // transaction of cash wallet
                $data = array(
                    'from_id' => $mid,
                    'from_account' => $m->username,
                    'to_id' => $gen1->id,
                    'transaction_date' => date('Y-m-d'),
                    'amount' => $c_wallet,
                    'package_id' => $p->id,
                    'wallet_type' => 'C Wallet',
                    'gen' => 'gen1'
                );
                DB::table('network_earning_transactions')->insert($data);
                // transaction of register wallet
                $data1 = array(
                    'from_id' => $mid,
                    'from_account' => $m->username,
                    'to_id' => $gen1->id,
                    'transaction_date' => date('Y-m-d'),
                    'amount' => $r_wallet,
                    'package_id' => $p->id,
                    'wallet_type' => 'R Wallet',
                    'gen' => 'gen1'
                );
                DB::table('network_earning_transactions')->insert($data1);
                // transaction of token wallet
                $data2 = array(
                    'from_id' => $mid,
                    'from_account' => $m->username,
                    'to_id' => $gen1->id,
                    'transaction_date' => date('Y-m-d'),
                    'amount' => $b_wallet,
                    'package_id' => $p->id,
                    'wallet_type' => 'B Wallet',
                    'gen' => 'gen1'
                );
                DB::table('network_earning_transactions')->insert($data2);
                // admin earning
                $ad = DB::table('admin_earnings')->where('id', 1)->first();
                $total = $ad->earning + $admin_fee;
                DB::table('admin_earnings')->where('id', 1)->update(['earning'=>$total]);
                $data = array(
                    'transaction_date' => date('Y-m-d'),
                    'amount' => $admin_fee,
                    'member_id' => $gen1->id,
                    'package_id' => $pid,
                    'description' => 'Commission Reward'
                );
                DB::table('admin_earning_transactions')->insert($data);

                // sencond gen
                $gen2 = DB::table('members')->where('username', $gen1->sponsor_id)->first();
                if($gen2!=null)
                {
                    // package of the gen2 sponsor
                    $p2 = DB::table('investments')
                        ->join('packages', 'investments.package_id', 'packages.id')
                        ->where('investments.member_id', $gen2->id)
                        ->select('packages.*')
                        ->first();
                    if($p2!=null)
                    {
                        $rate2 = $p2->gen2;
                    }
                    if($rate2>0)
                    {
                        $r2 = $rate2/100;
                        $earn2 = $p->price*$r2;
                        // spit to c_wallet, r_wallet and b_wallet
                        $c_wallet = $earn2*$wallet_rate->c_wallet;
                        $r_wallet = $earn2*$wallet_rate->r_wallet;
                        $b_wallet = $earn2*$wallet_rate->b_wallet;
                        $admin_fee = $earn2*$wallet_rate->admin_fee;
                        $wallet = array(
                            'cash_wallet' => Helper::encryptor('encrypt', Helper::encryptor('decrypt', $gen2->cash_wallet) + $c_wallet),
                            'register_wallet' => Helper::encryptor('encrypt', Helper::encryptor('decrypt', $gen2->register_wallet) + $r_wallet),
                            'token_wallet' => Helper::encryptor('encrypt', Helper::encryptor('decrypt', $gen2->token_wallet))
                        );
                    
                        DB::table('members')->where('id', $gen2->id)->update($wallet);
                        // transaction of cash wallet
                        $data = array(
                            'from_id' => $mid,
                            'from_account' => $m->username,
                            'to_id' => $gen2->id,
                            'transaction_date' => date('Y-m-d'),
                            'amount' => $c_wallet,
                            'package_id' => $p->id,
                            'wallet_type' => 'C Wallet',
                            'gen' => 'gen2'
                        );
                        DB::table('network_earning_transactions')->insert($data);
                        // transaction of register wallet
                        $data1 = array(
                            'from_id' => $mid,
                            'from_account' => $m->username,
                            'to_id' => $gen2->id,
                            'transaction_date' => date('Y-m-d'),
                            'amount' => $r_wallet,
                            'package_id' => $p->id,
                            'wallet_type' => 'R Wallet',
                            'gen' => 'gen2'
                        );
                        DB::table('network_earning_transactions')->insert($data1);
                        // transaction of token wallet
                        $data2 = array(
                            'from_id' => $mid,
                            'from_account' => $m->username,
                            'to_id' => $gen2->id,
                            'transaction_date' => date('Y-m-d'),
                            'amount' => $b_wallet,
                            'package_id' => $p->id,
                            'wallet_type' => 'B Wallet',
                            'gen' => 'gen2'
                        );
                        DB::table('network_earning_transactions')->insert($data2);
                        // admin earning
                        $ad = DB::table('admin_earnings')->where('id', 1)->first();
                        $total = $ad->earning + $admin_fee;
                        DB::table('admin_earnings')->where('id', 1)->update(['earning'=>$total]);
                        $data = array(
                            'transaction_date' => date('Y-m-d'),
                            'amount' => $admin_fee,
                            'member_id' => $gen2->id,
                            'package_id' => $pid,
                            'description' => 'Commission Reward'
                        );
                        DB::table('admin_earning_transactions')->insert($data);
                        // 3 gen
                        $gen3 = DB::table('members')->where('username', $gen2->sponsor_id)->first();
                        if($gen3!=null)
                        {
                            // package of the gen3 sponsor
                            $p3 = DB::table('investments')
                                ->join('packages', 'investments.package_id', 'packages.id')
                                ->where('investments.member_id', $gen3->id)
                                ->select('packages.*')
                                ->first();
                            if($p3!=null)
                            {
                                $rate3 = $p3->gen3;
                            }
                            $r3 = $rate3/100;
                            $earn3 = $p->price*$r3;
                            // spit to c_wallet, r_wallet and b_wallet
                            $c_wallet = $earn3*$wallet_rate->c_wallet;
                            $r_wallet = $earn3*$wallet_rate->r_wallet;
                            $b_wallet = $earn3*$wallet_rate->b_wallet;
                            $admin_fee = $earn3*$wallet_rate->admin_fee;
                            $wallet = array(
                                'cash_wallet' => Helper::encryptor('encrypt', Helper::encryptor('decrypt', $gen3->cash_wallet) + $c_wallet),
                                'register_wallet' => Helper::encryptor('encrypt', Helper::encryptor('decrypt', $gen3->register_wallet) + $r_wallet),
                                'token_wallet' => Helper::encryptor('encrypt', Helper::encryptor('decrypt', $gen3->token_wallet))
                            );
                        
                            DB::table('members')->where('id', $gen3->id)->update($wallet);
                            // transaction of c wallet
                            $data = array(
                                'from_id' => $mid,
                                'from_account' => $m->username,
                                'to_id' => $gen3->id,
                                'transaction_date' => date('Y-m-d'),
                                'amount' => $c_wallet,
                                'package_id' => $p->id,
                                'wallet_type' => 'C Wallet',
                                'gen' => 'gen3'
                            );
                            DB::table('network_earning_transactions')->insert($data);
                            // transaction of register wallet
                            $data1 = array(
                                'from_id' => $mid,
                                'from_account' => $m->username,
                                'to_id' => $gen3->id,
                                'transaction_date' => date('Y-m-d'),
                                'amount' => $r_wallet,
                                'package_id' => $p->id,
                                'wallet_type' => 'R Wallet',
                                'gen' => 'gen3'
                            );
                            DB::table('network_earning_transactions')->insert($data1);
                            // transaction of token wallet
                            $data2 = array(
                                'from_id' => $mid,
                                'from_account' => $m->username,
                                'to_id' => $gen3->id,
                                'transaction_date' => date('Y-m-d'),
                                'amount' => $b_wallet,
                                'package_id' => $p->id,
                                'wallet_type' => 'B Wallet',
                                'gen' => 'gen3'
                            );
                            DB::table('network_earning_transactions')->insert($data2);
                            // admin earning
                            $ad = DB::table('admin_earnings')->where('id', 1)->first();
                            $total = $ad->earning + $admin_fee;
                            DB::table('admin_earnings')->where('id', 1)->update(['earning'=>$total]);
                            $data = array(
                                'transaction_date' => date('Y-m-d'),
                                'amount' => $admin_fee,
                                'member_id' => $gen3->id,
                                'package_id' => $pid,
                                'description' => 'Commission Reward'
                            );
                            DB::table('admin_earning_transactions')->insert($data);
                            // gen 4
                            $gen4 = DB::table('members')->where('username', $gen3->sponsor_id)->first();
                            if($gen4!=null)
                            {
                                // package of the gen3 sponsor
                                $p4 = DB::table('investments')
                                    ->join('packages', 'investments.package_id', 'packages.id')
                                    ->where('investments.member_id', $gen4->id)
                                    ->select('packages.*')
                                    ->first();
                                if($p4!=null)
                                {
                                    $rate4 = $p4->gen4;
                                }
                                $r4 = $rate4/100;
                                $earn4 = $p->price*$r4;
                                // spit to c_wallet, r_wallet and b_wallet
                                $c_wallet = $earn4*$wallet_rate->c_wallet;
                                $r_wallet = $earn4*$wallet_rate->r_wallet;
                                $b_wallet = $earn4*$wallet_rate->b_wallet;
                                $admin_fee = $earn4*$wallet_rate->admin_fee;
                                $wallet = array(
                                    'cash_wallet' => Helper::encryptor('encrypt', Helper::encryptor('decrypt', $gen4->cash_wallet) + $c_wallet),
                                    'register_wallet' => Helper::encryptor('encrypt', Helper::encryptor('decrypt', $gen4->register_wallet) + $r_wallet),
                                    'token_wallet' => Helper::encryptor('encrypt', Helper::encryptor('decrypt', $gen4->token_wallet))
                                );
                            
                                DB::table('members')->where('id', $gen4->id)->update($wallet);
                               // transaction of cash wallet
                                $data = array(
                                    'from_id' => $mid,
                                    'from_account' => $m->username,
                                    'to_id' => $gen4->id,
                                    'transaction_date' => date('Y-m-d'),
                                    'amount' => $c_wallet,
                                    'package_id' => $p->id,
                                    'wallet_type' => 'C Wallet',
                                    'gen' => 'gen4'
                                );
                                DB::table('network_earning_transactions')->insert($data);
                                // transaction of register wallet
                                $data1 = array(
                                    'from_id' => $mid,
                                    'from_account' => $m->username,
                                    'to_id' => $gen4->id,
                                    'transaction_date' => date('Y-m-d'),
                                    'amount' => $r_wallet,
                                    'package_id' => $p->id,
                                    'wallet_type' => 'R Wallet',
                                    'gen' => 'gen4'
                                );
                                DB::table('network_earning_transactions')->insert($data1);
                                // transaction of token wallet
                                $data2 = array(
                                    'from_id' => $mid,
                                    'from_account' => $m->username,
                                    'to_id' => $gen4->id,
                                    'transaction_date' => date('Y-m-d'),
                                    'amount' => $b_wallet,
                                    'package_id' => $p->id,
                                    'wallet_type' => 'B Wallet',
                                    'gen' => 'gen4'
                                );
                                DB::table('network_earning_transactions')->insert($data2);
                                // admin earning
                                $ad = DB::table('admin_earnings')->where('id', 1)->first();
                                $total = $ad->earning + $admin_fee;
                                DB::table('admin_earnings')->where('id', 1)->update(['earning'=>$total]);
                                $data = array(
                                    'transaction_date' => date('Y-m-d'),
                                    'amount' => $admin_fee,
                                    'member_id' => $gen4->id,
                                    'package_id' => $pid,
                                    'description' => 'Commission Reward'
                                );
                                DB::table('admin_earning_transactions')->insert($data);

                                // gen 5
                                $gen5 = DB::table('members')->where('username', $gen4->sponsor_id)->first();
                                if($gen5!=null)
                                {
                                    // package of the gen3 sponsor
                                    $p5 = DB::table('investments')
                                        ->join('packages', 'investments.package_id', 'packages.id')
                                        ->where('investments.member_id', $gen5->id)
                                        ->select('packages.*')
                                        ->first();
                                    if($p5!=null)
                                    {
                                        $rate5 = $p5->gen5;
                                    }
                                    $r5 = $rate5/100;
                                    $earn5 = $p->price*$r5;
                                    // spit to c_wallet, r_wallet and b_wallet
                                    $c_wallet = $earn5*$wallet_rate->c_wallet;
                                    $r_wallet = $earn5*$wallet_rate->r_wallet;
                                    $b_wallet = $earn5*$wallet_rate->b_wallet;
                                    $admin_fee = $earn5*$wallet_rate->admin_fee;
                                    $wallet = array(
                                        'cash_wallet' => Helper::encryptor('encrypt', Helper::encryptor('decrypt', $gen5->cash_wallet) + $c_wallet),
                                        'register_wallet' => Helper::encryptor('encrypt', Helper::encryptor('decrypt', $gen5->register_wallet) + $r_wallet),
                                        'token_wallet' => Helper::encryptor('encrypt', Helper::encryptor('decrypt', $gen5->token_wallet))
                                    );
                                
                                    DB::table('members')->where('id', $gen5->id)->update($wallet);
                                    // transaction of cash wallet
                                    $data = array(
                                        'from_id' => $mid,
                                        'from_account' => $m->username,
                                        'to_id' => $gen5->id,
                                        'transaction_date' => date('Y-m-d'),
                                        'amount' => $c_wallet,
                                        'package_id' => $p->id,
                                        'wallet_type' => 'cash wallet',
                                        'gen' => 'gen5'
                                    );
                                    DB::table('network_earning_transactions')->insert($data);
                                    // transaction of register wallet
                                    $data1 = array(
                                        'from_id' => $mid,
                                        'from_account' => $m->username,
                                        'to_id' => $gen5->id,
                                        'transaction_date' => date('Y-m-d'),
                                        'amount' => $r_wallet,
                                        'package_id' => $p->id,
                                        'wallet_type' => 'R Wallet',
                                        'gen' => 'gen5'
                                    );
                                    DB::table('network_earning_transactions')->insert($data1);
                                    // transaction of token wallet
                                    $data2 = array(
                                        'from_id' => $mid,
                                        'from_account' => $m->username,
                                        'to_id' => $gen5->id,
                                        'transaction_date' => date('Y-m-d'),
                                        'amount' => $b_wallet,
                                        'package_id' => $p->id,
                                        'wallet_type' => 'B Wallet',
                                        'gen' => 'gen5'
                                    );
                                    DB::table('network_earning_transactions')->insert($data2);
                                    // admin earning
                                    $ad = DB::table('admin_earnings')->where('id', 1)->first();
                                    $total = $ad->earning + $admin_fee;
                                    DB::table('admin_earnings')->where('id', 1)->update(['earning'=>$total]);
                                    $data = array(
                                        'transaction_date' => date('Y-m-d'),
                                        'amount' => $admin_fee,
                                        'member_id' => $gen5->id,
                                        'package_id' => $pid,
                                        'description' => 'Commission Reward'
                                    );
                                    DB::table('admin_earning_transactions')->insert($data);
                                    // gen 6
                                    $gen6 = DB::table('members')->where('username', $gen5->id)->first();
                                    if($gen6!=null)
                                    {
                                         // package of the gen3 sponsor
                                        $p6 = DB::table('investments')
                                            ->join('packages', 'investments.package_id', 'packages.id')
                                            ->where('investments.member_id', $gen6->id)
                                            ->select('packages.*')
                                            ->first();
                                        if($p6!=null)
                                        {
                                            $rate6 = $p6->gen6;
                                        }
                                        $r6 = $rate6/100;
                                        $earn6 = $p->price*$r6;
                                         // spit to c_wallet, r_wallet and b_wallet
                                        $c_wallet = $earn6*$wallet_rate->c_wallet;
                                        $r_wallet = $earn6*$wallet_rate->r_wallet;
                                        $b_wallet = $earn6*$wallet_rate->b_wallet;
                                        $admin_fee = $earn6*$wallet_rate->admin_fee;
                                        $wallet = array(
                                            'cash_wallet' => Helper::encryptor('encrypt', Helper::encryptor('decrypt', $gen6->cash_wallet) + $c_wallet),
                                            'register_wallet' => Helper::encryptor('encrypt', Helper::encryptor('decrypt', $gen6->register_wallet) + $r_wallet),
                                            'token_wallet' => Helper::encryptor('encrypt', Helper::encryptor('decrypt', $gen6->token_wallet))
                                        );
                                    
                                        DB::table('members')->where('id', $gen6->id)->update($wallet);

                                       // transaction of cash wallet
                                        $data = array(
                                            'from_id' => $mid,
                                            'from_account' => $m->username,
                                            'to_id' => $gen6->id,
                                            'transaction_date' => date('Y-m-d'),
                                            'amount' => $c_wallet,
                                            'package_id' => $p->id,
                                            'wallet_type' => 'cash wallet',
                                            'gen' => 'gen6'
                                        );
                                        DB::table('network_earning_transactions')->insert($data);
                                        // transaction of register wallet
                                        $data1 = array(
                                            'from_id' => $mid,
                                            'from_account' => $m->username,
                                            'to_id' => $gen6->id,
                                            'transaction_date' => date('Y-m-d'),
                                            'amount' => $r_wallet,
                                            'package_id' => $p->id,
                                            'wallet_type' => 'R Wallet',
                                            'gen' => 'gen6'
                                        );
                                        DB::table('network_earning_transactions')->insert($data1);
                                        // transaction of token wallet
                                        $data2 = array(
                                            'from_id' => $mid,
                                            'from_account' => $m->username,
                                            'to_id' => $gen6->id,
                                            'transaction_date' => date('Y-m-d'),
                                            'amount' => $b_wallet,
                                            'package_id' => $p->id,
                                            'wallet_type' => 'B Wallet',
                                            'gen' => 'gen6'
                                        );
                                        DB::table('network_earning_transactions')->insert($data2);
                                        // admin earning
                                        $ad = DB::table('admin_earnings')->where('id', 1)->first();
                                        $total = $ad->earning + $admin_fee;
                                        DB::table('admin_earnings')->where('id', 1)->update(['earning'=>$total]);
                                        $data = array(
                                            'transaction_date' => date('Y-m-d'),
                                            'amount' => $admin_fee,
                                            'member_id' => $gen6->id,
                                            'package_id' => $pid,
                                            'description' => 'Commission Reward'
                                        );
                                        DB::table('admin_earning_transactions')->insert($data);

                                    }
                                    else{
                                        // no gen 6
                                    }
                                }
                            }
                            else{
                                // no gen 4
                            }
                        }
                        else{
                            // no gen 3
                        }
                    }
                    else{
                        // nothing to calculate
                    }
                }
                else{
                    // no gen 2
                }
            }
            else{
                // nothing to calculate
            }
        }
        else{
            // no gen, nothing to do
        }
    }
    

}