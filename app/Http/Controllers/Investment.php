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
            $data = array(
                'member_id' => $p->member_id,
                'package_id' => $p->package_id,
                'start_date' => $sdate,
                'end_date' => $edate,
                'amount' => $amount,
                'month' => $i
            );
            DB::table('payment_schedules')->insert($data);
            $sdate = date('Y-m-d', strtotime($edate . " + 1 day"));
        }
    }

    public static function earning($mid, $date, $pid)
    {
        $pay = DB::table('payment_schedules')->where('start_date', '<=', $date)
            ->where('end_date', '>', $date)
            ->where('is_paid', 0)
            ->first();
        if($pay!=null)
        {
            $admin_fee = 0.1*$pay->amount;
            $c_wallet = 0.5*$pay->amount;
            $r_wallet = 0.3*$pay->amount;
            $t_wallet = 0.1*$pay->amount;

            // admin earning
            $ad = DB::table('admin_earnings')->where('id', 1)->first();
            $total = $ad->earning + $admin_fee;
            DB::table('admin_earnings')->where('id', 1)->update(['earning'=>$total]);
            $data = array(
                'transaction_date' => date('Y-m-d'),
                'amount' => $admin_fee,
                'member_id' => $mid,
                'package_id' => $pid
            );
            DB::table('admin_earning_transactions')->insert($data);
            // member earning transaction
            $m = DB::table('members')->where('id', $mid)->first();
            $c = $m->cash_wallet + $c_wallet;
            $r = $m->register_wallet + $r_wallet;
            $t = $m->token_wallet + $t_wallet;
            $data = array(
                'cash_wallet' => $c,
                'register_wallet' => $r,
                'token_wallet' => $t
            );
            DB::table('members')->where('id', $mid)->update($data);
            DB::table('payment_schedules')->where('id', $pay->id)->update(['is_paid'=>1]);
            //save transaction
            $data = array(
                'member_id' => $mid,
                'transaction_date' => date('Y-m-d'),
                'amount' => $c_wallet,
                'package_id' => $pid,
                'wallet_type' => 'cash wallet'
            );
            DB::table('member_earning_transactions')->insert($data);
            $data = array(
                'member_id' => $mid,
                'transaction_date' => date('Y-m-d'),
                'amount' => $r_wallet,
                'package_id' => $pid,
                'wallet_type' => 'register wallet'
            );
            DB::table('member_earning_transactions')->insert($data);
            $data = array(
                'member_id' => $mid,
                'transaction_date' => date('Y-m-d'),
                'amount' => $t_wallet,
                'package_id' => $pid,
                'wallet_type' => 'token wallet'
            );
            DB::table('member_earning_transactions')->insert($data);
            // earning for referals
            self::network_earning($mid, $pid);
        }
    }
    public static function network_earning($mid, $pid)
    {
        $m = DB::table('members')->where('id', $mid)->first();
        $p = DB::table('packages')->where('id', $pid)->first();
        $rate = $p->gen1;
        $rate1 = $p->gen2;
        $rate2 = $p->gen3;
        $rate3 = $p->gen4;
        $rate4 = $p->gen5;
        $rate5 = $p->gen6;
        // first gen
        $gen1 = DB::table('members')->where('username', $m->sponsor_id)->first();
        if($gen1!=null)
        {
            // he has first gen
            if($rate>0)
            {
                $r = $rate/100;
                $earn = $p->price * $r;
                $total = $gen1->cash_wallet + $earn;
                DB::table('members')->where('id', $gen1->id)->update(['cash_wallet'=>$total]);
                $data = array(
                    'from_id' => $mid,
                    'to_id' => $gen1->id,
                    'transaction_date' => date('Y-m-d'),
                    'amount' => $earn,
                    'package_id' => $p->id,
                    'wallet_type' => 'cash wallet',
                    'gen' => 'gen1'
                );
                DB::table('network_earning_transactions')->insert($data);
                // sencond gen
                $gen2 = DB::table('members')->where('sponsor_id', $gen1->sponsor_id)->first();
                if($gen2!=null)
                {
                    if($rate1>0)
                    {
                        $r1 = $rate1/100;
                        $earn1 = $p->price*$r1;
                        $total1 = $gen2->cash_wallet + $earn1;
                        DB::table('members')->where('id', $gen2->id)->update(['cash_wallet'=>$total1]);
                        $data = array(
                            'from_id' => $mid,
                            'to_id' => $gen2->id,
                            'transaction_date' => date('Y-m-d'),
                            'amount' => $earn1,
                            'package_id' => $p->id,
                            'wallet_type' => 'cash wallet',
                            'gen' => 'gen2'
                        );
                        DB::table('network_earning_transactions')->insert($data);
                        // 3 gen
                        $gen3 = DB::table('members')->where('sponsor_id', $gen2->sponsor_id)->first();
                        if($gen3!=null)
                        {
                            $r2 = $rate2/100;
                            $earn2 = $p->price*$r2;
                            $total2 = $gen3->cash_wallet + $earn2;
                            DB::table('members')->where('id', $gen3->id)->update(['cash_wallet'=>$total2]);
                            $data = array(
                                'from_id' => $mid,
                                'to_id' => $gen3->id,
                                'transaction_date' => date('Y-m-d'),
                                'amount' => $earn2,
                                'package_id' => $p->id,
                                'wallet_type' => 'cash wallet',
                                'gen' => 'gen3'
                            );
                            DB::table('network_earning_transactions')->insert($data);
                            // gen 4
                            $gen4 = DB::table('members')->where('sponsor_id', $gen3->sponsor_id)->first();
                            if($gen4!=null)
                            {
                                $r3 = $rate3/100;
                                $earn3 = $p->price*$r3;
                                $total3 = $gen4->cash_wallet + $earn3;
                                DB::table('members')->where('id', $gen4->id)->update(['cash_wallet'=>$total3]);
                                $data = array(
                                    'from_id' => $mid,
                                    'to_id' => $gen4->id,
                                    'transaction_date' => date('Y-m-d'),
                                    'amount' => $earn3,
                                    'package_id' => $p->id,
                                    'wallet_type' => 'cash wallet',
                                    'gen' => 'gen4'
                                );
                                DB::table('network_earning_transactions')->insert($data);
                                // gen 5
                                $gen5 = DB::table('members')->where('sponsor_id', $gen4->sponsor_id)->first();
                                if($gen5!=null)
                                {
                                    $r4 = $rate4/100;
                                    $earn4 = $p->price*$r4;
                                    $total4 = $gen4->cash_wallet + $earn4;
                                    DB::table('members')->where('id', $gen5->id)->update(['cash_wallet'=>$total4]);
                                    $data = array(
                                        'from_id' => $mid,
                                        'to_id' => $gen5->id,
                                        'transaction_date' => date('Y-m-d'),
                                        'amount' => $earn4,
                                        'package_id' => $p->id,
                                        'wallet_type' => 'cash wallet',
                                        'gen' => 'gen5'
                                    );
                                    DB::table('network_earning_transactions')->insert($data);
                                    // gen 6
                                    $gen6 = DB::table('members')->where('sponsor_id', $gen5->id)->first();
                                    if($gen6!=null)
                                    {
                                        $r5 = $rate5/100;
                                        $earn5 = $p->price*$r5;
                                        $total5 = $gen6->cash_wallet + $earn5;
                                        DB::table('members')->where('id', $gen6->id)->update(['cash_wallet'=>$total5]);
                                        $data = array(
                                            'from_id' => $mid,
                                            'to_id' => $gen6->id,
                                            'transaction_date' => date('Y-m-d'),
                                            'amount' => $earn5,
                                            'package_id' => $p->id,
                                            'wallet_type' => 'cash wallet',
                                            'gen' => 'gen6'
                                        );
                                        DB::table('network_earning_transactions')->insert($data);
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
    
    // calculate bonus
    public function bonus($mid, $pid)
    {
        $m = DB::table('members')->where('id', $mid)->first();
        $p = DB::table('packages')->where('id', $pid)->first();
        $rate = $p->gen1;
        $rate1 = $p->gen2;
        $rate2 = $p->gen3;
        $rate3 = $p->gen4;
        $rate4 = $p->gen5;
        $rate5 = $p->gen6;
        // first gen
        $gen1 = DB::table('members')->where('username', $m->sponsor_id)->first();
        if($gen1!=null)
        {
            // he has first gen
            if($rate>0)
            {
                $r = $rate/100;
                $earn = $p->price * $r;
                $total = $gen1->cash_wallet + $earn;
                DB::table('members')->where('id', $gen1->id)->update(['cash_wallet'=>$total]);
                $data = array(
                    'from_id' => $mid,
                    'to_id' => $gen1->id,
                    'transaction_date' => date('Y-m-d'),
                    'amount' => $earn,
                    'package_id' => $p->id,
                    'wallet_type' => 'cash wallet',
                    'gen' => 'gen1'
                );
                DB::table('network_earning_transactions')->insert($data);
                // sencond gen
                $gen2 = DB::table('members')->where('sponsor_id', $gen1->sponsor_id)->first();
                if($gen2!=null)
                {
                    if($rate1>0)
                    {
                        $r1 = $rate1/100;
                        $earn1 = $p->price*$r1;
                        $total1 = $gen2->cash_wallet + $earn1;
                        DB::table('members')->where('id', $gen2->id)->update(['cash_wallet'=>$total1]);
                        $data = array(
                            'from_id' => $mid,
                            'to_id' => $gen2->id,
                            'transaction_date' => date('Y-m-d'),
                            'amount' => $earn1,
                            'package_id' => $p->id,
                            'wallet_type' => 'cash wallet',
                            'gen' => 'gen2'
                        );
                        DB::table('network_earning_transactions')->insert($data);
                        // 3 gen
                        $gen3 = DB::table('members')->where('sponsor_id', $gen2->sponsor_id)->first();
                        if($gen3!=null)
                        {
                            $r2 = $rate2/100;
                            $earn2 = $p->price*$r2;
                            $total2 = $gen3->cash_wallet + $earn2;
                            DB::table('members')->where('id', $gen3->id)->update(['cash_wallet'=>$total2]);
                            $data = array(
                                'from_id' => $mid,
                                'to_id' => $gen3->id,
                                'transaction_date' => date('Y-m-d'),
                                'amount' => $earn2,
                                'package_id' => $p->id,
                                'wallet_type' => 'cash wallet',
                                'gen' => 'gen3'
                            );
                            DB::table('network_earning_transactions')->insert($data);
                            // gen 4
                            $gen4 = DB::table('members')->where('sponsor_id', $gen3->sponsor_id)->first();
                            if($gen4!=null)
                            {
                                $r3 = $rate3/100;
                                $earn3 = $p->price*$r3;
                                $total3 = $gen4->cash_wallet + $earn3;
                                DB::table('members')->where('id', $gen4->id)->update(['cash_wallet'=>$total3]);
                                $data = array(
                                    'from_id' => $mid,
                                    'to_id' => $gen4->id,
                                    'transaction_date' => date('Y-m-d'),
                                    'amount' => $earn3,
                                    'package_id' => $p->id,
                                    'wallet_type' => 'cash wallet',
                                    'gen' => 'gen4'
                                );
                                DB::table('network_earning_transactions')->insert($data);
                                // gen 5
                                $gen5 = DB::table('members')->where('sponsor_id', $gen4->sponsor_id)->first();
                                if($gen5!=null)
                                {
                                    $r4 = $rate4/100;
                                    $earn4 = $p->price*$r4;
                                    $total4 = $gen4->cash_wallet + $earn4;
                                    DB::table('members')->where('id', $gen5->id)->update(['cash_wallet'=>$total4]);
                                    $data = array(
                                        'from_id' => $mid,
                                        'to_id' => $gen5->id,
                                        'transaction_date' => date('Y-m-d'),
                                        'amount' => $earn4,
                                        'package_id' => $p->id,
                                        'wallet_type' => 'cash wallet',
                                        'gen' => 'gen5'
                                    );
                                    DB::table('network_earning_transactions')->insert($data);
                                    // gen 6
                                    $gen6 = DB::table('members')->where('sponsor_id', $gen5->id)->first();
                                    if($gen6!=null)
                                    {
                                        $r5 = $rate5/100;
                                        $earn5 = $p->price*$r5;
                                        $total5 = $gen6->cash_wallet + $earn5;
                                        DB::table('members')->where('id', $gen6->id)->update(['cash_wallet'=>$total5]);
                                        $data = array(
                                            'from_id' => $mid,
                                            'to_id' => $gen6->id,
                                            'transaction_date' => date('Y-m-d'),
                                            'amount' => $earn5,
                                            'package_id' => $p->id,
                                            'wallet_type' => 'cash wallet',
                                            'gen' => 'gen6'
                                        );
                                        DB::table('network_earning_transactions')->insert($data);
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