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
            $c = Helper::encryptor('decrypt', $m->cash_wallet) + $c_wallet;
            $r = Helper::encryptor('decrypt', $m->register_wallet) + $r_wallet;
            $t = Helper::encryptor('decrypt', $m->token_wallet) + $t_wallet;
            $data = array(
                'cash_wallet' => Helper::encryptor('encrypt', $c),
                'register_wallet' => Helper::encryptor('encrypt', $r),
                'token_wallet' => Helper::encryptor('encrypt', $t)
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
                $total = Helper::encryptor('decrypt', $gen1->cash_wallet) + $earn;
                DB::table('members')->where('id', $gen1->id)->update(['cash_wallet'=>Helper::encryptor('encrypt',$total)]);
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
                        $total1 = Helper::encryptor('decrypt', $gen2->cash_wallet) + $earn1;
                        DB::table('members')->where('id', $gen2->id)->update(['cash_wallet'=>Helper::encryptor('encrypt', $total1)]);
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
                            $total2 = Helper::encryptor('decrypt', $gen3->cash_wallet) + $earn2;
                            DB::table('members')->where('id', $gen3->id)->update(['cash_wallet'=>Helper::encryptor('encrypt',$total2)]);
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
                                $total3 = Helper::encryptor('decrypt', $gen4->cash_wallet) + $earn3;
                                DB::table('members')->where('id', $gen4->id)->update(['cash_wallet'=>Helper::encryptor('encrypt', $total3)]);
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
                                    $total4 = Helper::encryptor('decrypt', $gen5->cash_wallet) + $earn4;
                                    DB::table('members')->where('id', $gen5->id)->update(['cash_wallet'=>Helper::encryptor('encrypt', $total4)]);
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
                                        $total5 = Helper::encryptor('decrypt', $gen6->cash_wallet) + $earn5;
                                        DB::table('members')->where('id', $gen6->id)->update(['cash_wallet'=>Helper::encryptor('encrypt', $total5)]);
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
    public static function bonus($mid)
    {
        $m = DB::table('members')->where('id', $mid)->first();
        // current date
        $year = date('Y');
        $month = date('m');
        $bm = $month - 1;
        // check if we already calculate already
        if($month==1)
        {
            $bm = 12;
            $year = $year - 1;
        }
        $bonus = DB::table('monthly_bonus')->where('member_id', $m->id)
            ->where('month', $bm)
            ->where('year', $year)
            ->first();
        if($bonus==null)
        {

            $gens = DB::table('members')->where('sponsor_id', $m->username)->get();
            $total = 0;
            foreach($gens as $g)
            {
                $inv = DB::table('investments')
                    ->join('packages', 'investments.package_id', 'packages.id')
                    ->where('member_id', $g->id)
                    ->where('is_expired', 0)
                    ->select('packages.price')
                    ->first();
                if($inv!=null)
                {
                    $total = $total + $inv->price;
                }
            }
            // kind diamound
            $rate1 = DB::table('commission_plans')->where('id', 8)->first();
            $rate2 = DB::table('commission_plans')->where('id', 7)->first();
            $rate3 = DB::table('commission_plans')->where('id', 6)->first();
            $rate4 = DB::table('commission_plans')->where('id', 5)->first();
            $rate5 = DB::table('commission_plans')->where('id', 4)->first();
            $rate6 = DB::table('commission_plans')->where('id', 3)->first();
            $rate7 = DB::table('commission_plans')->where('id', 2)->first();
            $rate8 = DB::table('commission_plans')->where('id', 1)->first();
            if(count($gens)>=$rate1->direct_sponsor && $total>=$rate1->sale)
            {
                $amount = $rate1->bonus_rate*$total;
                $data = array(
                    'member_id' => $mid,
                    'amount' => $amount,
                    'alc' => $rate1->alc,
                    'bonus_date' => date('Y-m-d'),
                    'month' => date('m'),
                    'year' => date('Y')
                );
                DB::table('monthly_bonus')->insert($data);
                // add to wallet
                $bwallet = Helper::encryptor('decrypt', $m->token_wallet) + $rate1->alc;
                $cwallet = Helper::encryptor('decrypt', $m->cash_wallet) + $amount;
                DB::table('members')->where('id', $mid)->update(['cash_wallet'=>Helper::encryptor('encrypt', $cwallet), 'token_wallet'=>Helper::encryptor('encrypt', $bwallet)]);
                $data1 = array(
                    'member_id' => $mid,
                    'amount' => $rate1->alc,
                    'bonus_date' => date('Y-m-d')
                );
                DB::table('alc_bonus_transactions')->insert($data1);
                $data = array(
                    'member_id' => $mid,
                    'transaction_date' => date('Y-m-d'),
                    'amount' => $amount,
                    'wallet_type' => 'cwallet'
                );
                DB::table('bonus_earning_transactions')->insert($data);
                return $amount;
            }
            // queen diamound

            else if(count($gens)>=$rate2->direct_sponsor && $total>=$rate2->sale)
            {
                $amount = $rate2->bonus_rate*$total;
                $data = array(
                    'member_id' => $mid,
                    'amount' => $amount,
                    'alc' => $rate2->alc,
                    'bonus_date' => date('Y-m-d'),
                    'month' => date('m'),
                    'year' => date('Y')
                );
                DB::table('monthly_bonus')->insert($data);
                // add to wallet
                $bwallet = Helper::encryptor('decrypt', $m->token_wallet) + $rate2->alc;
                $cwallet = Helper::encryptor('decrypt', $m->cash_wallet) + $amount;
                DB::table('members')->where('id', $mid)->update(['cash_wallet'=>Helper::encryptor('encrypt', $cwallet), 'token_wallet'=>Helper::encryptor('encrypt', $bwallet)]);
                $data1 = array(
                    'member_id' => $mid,
                    'amount' => $rate2->alc,
                    'bonus_date' => date('Y-m-d')
                );
                DB::table('alc_bonus_transactions')->insert($data1);
                $data = array(
                    'member_id' => $mid,
                    'transaction_date' => date('Y-m-d'),
                    'amount' => $amount,
                    'wallet_type' => 'cwallet'
                );
                DB::table('bonus_earning_transactions')->insert($data);
                return $amount;
            }
             // diamound
            else if(count($gens)>=$rate3->direct_sponsor && $total>=$rate3->sale)
            {
                $amount = $rate3->bonus_rate*$total;
                $data = array(
                    'member_id' => $mid,
                    'amount' => $amount,
                    'alc' => $rate3->alc,
                    'bonus_date' => date('Y-m-d'),
                    'month' => date('m'),
                    'year' => date('Y')
                );
                DB::table('monthly_bonus')->insert($data);
                // add to wallet
                $bwallet = Helper::encryptor('decrypt', $m->token_wallet) + $rate3->alc;
                $cwallet = Helper::encryptor('decrypt', $m->cash_wallet) + $amount;
                DB::table('members')->where('id', $mid)->update(['cash_wallet'=>Helper::encryptor('encrypt', $cwallet), 'token_wallet'=>Helper::encryptor('encrypt', $bwallet)]);
                $data1 = array(
                    'member_id' => $mid,
                    'amount' => $rate3->alc,
                    'bonus_date' => date('Y-m-d')
                );
                DB::table('alc_bonus_transactions')->insert($data1);
                $data = array(
                    'member_id' => $mid,
                    'transaction_date' => date('Y-m-d'),
                    'amount' => $amount,
                    'wallet_type' => 'cwallet'
                );
                DB::table('bonus_earning_transactions')->insert($data);
                return $amount;
            }
             // gold
            else if(count($gens)>=$rate4->direct_sponsor && $total>=$rate4->sale)
            {
                $amount = $rate4->bonus_rate*$total;
                $data = array(
                    'member_id' => $mid,
                    'amount' => $amount,
                    'alc' => $rate4->alc,
                    'bonus_date' => date('Y-m-d'),
                    'month' => date('m'),
                    'year' => date('Y')
                );
                DB::table('monthly_bonus')->insert($data);
                // add to wallet
                $bwallet = Helper::encryptor('decrypt', $m->token_wallet) + $rate4->alc;
                $cwallet = Helper::encryptor('decrypt', $m->cash_wallet) + $amount;
                DB::table('members')->where('id', $mid)->update(['cash_wallet'=>Helper::encryptor('encrypt', $cwallet), 'token_wallet'=>Helper::encryptor('encrypt', $bwallet)]);
                $data1 = array(
                    'member_id' => $mid,
                    'amount' => $rate4->alc,
                    'bonus_date' => date('Y-m-d')
                );
                DB::table('alc_bonus_transactions')->insert($data1);
                $data = array(
                    'member_id' => $mid,
                    'transaction_date' => date('Y-m-d'),
                    'amount' => $amount,
                    'wallet_type' => 'cwallet'
                );
                DB::table('bonus_earning_transactions')->insert($data);
                return $amount;
            }
            // platinuim
            else if(count($gens)>=$rate5->direct_sponsor && $total>=$rate5->sale)
            {
                $amount = $rate5->bonus_rate*$total;
                $data = array(
                    'member_id' => $mid,
                    'amount' => $amount,
                    'alc' => $rate5->alc,
                    'bonus_date' => date('Y-m-d'),
                    'month' => date('m'),
                    'year' => date('Y')
                );
                DB::table('monthly_bonus')->insert($data);
                // add to wallet
                $bwallet = Helper::encryptor('decrypt', $m->token_wallet) + $rate5->alc;
                $cwallet = Helper::encryptor('decrypt', $m->cash_wallet) + $amount;
                DB::table('members')->where('id', $mid)->update(['cash_wallet'=>Helper::encryptor('encrypt', $cwallet), 'token_wallet'=>Helper::encryptor('encrypt', $bwallet)]);
                $data1 = array(
                    'member_id' => $mid,
                    'amount' => $rate5->alc,
                    'bonus_date' => date('Y-m-d')
                );
                DB::table('alc_bonus_transactions')->insert($data1);
                $data = array(
                    'member_id' => $mid,
                    'transaction_date' => date('Y-m-d'),
                    'amount' => $amount,
                    'wallet_type' => 'cwallet'
                );
                DB::table('bonus_earning_transactions')->insert($data);
                return $amount;
            }
            // silver
            else if(count($gens)>=$rate6->direct_sponsor && $total>=$rate6->sale)
            {
                $amount = $rate6->bonus_rate*$total;
                $data = array(
                    'member_id' => $mid,
                    'amount' => $amount,
                    'alc' => $rate6->alc,
                    'bonus_date' => date('Y-m-d'),
                    'month' => date('m'),
                    'year' => date('Y')
                );
                DB::table('monthly_bonus')->insert($data);
                // add to wallet
                $bwallet = Helper::encryptor('decrypt', $m->token_wallet) + $rate6->alc;
                $cwallet = Helper::encryptor('decrypt', $m->cash_wallet) + $amount;
                DB::table('members')->where('id', $mid)->update(['cash_wallet'=>Helper::encryptor('encrypt', $cwallet), 'token_wallet'=>Helper::encryptor('encrypt', $bwallet)]);
                
                $data1 = array(
                    'member_id' => $mid,
                    'amount' => $rate6->alc,
                    'bonus_date' => date('Y-m-d')
                );
                DB::table('alc_bonus_transactions')->insert($data1);
                $data = array(
                    'member_id' => $mid,
                    'transaction_date' => date('Y-m-d'),
                    'amount' => $amount,
                    'wallet_type' => 'cwallet'
                );
                DB::table('bonus_earning_transactions')->insert($data);
                return $amount;
            }
             // fronze
            else if(count($gens)>=$rate7->direct_sponsor && $total>=$rate7->sale)
            {
                $amount = $rate1->bonus_rate*$total;
                $data = array(
                    'member_id' => $mid,
                    'amount' => $amount,
                    'alc' => $rate7->alc,
                    'bonus_date' => date('Y-m-d'),
                    'month' => date('m'),
                    'year' => date('Y')
                );
                DB::table('monthly_bonus')->insert($data);
                // add to wallet
               $bwallet = Helper::encryptor('decrypt', $m->token_wallet) + $rate7->alc;
                $cwallet = Helper::encryptor('decrypt', $m->cash_wallet) + $amount;
                DB::table('members')->where('id', $mid)->update(['cash_wallet'=>Helper::encryptor('encrypt', $cwallet), 'token_wallet'=>Helper::encryptor('encrypt', $bwallet)]);
                
                $data1 = array(
                    'member_id' => $mid,
                    'amount' => $rate7->alc,
                    'bonus_date' => date('Y-m-d')
                );
                DB::table('alc_bonus_transactions')->insert($data1);
                $data = array(
                    'member_id' => $mid,
                    'transaction_date' => date('Y-m-d'),
                    'amount' => $amount,
                    'wallet_type' => 'cwallet'
                );
                DB::table('bonus_earning_transactions')->insert($data);
                return $amount;
            }
            // fronze
            if(count($gens)>=$rate8->direct_sponsor && $total>=$rate8->sale)
            {
                $amount = $rate8->bonus_rate*$total;
                $data = array(
                    'member_id' => $mid,
                    'amount' => $amount,
                    'alc' => $rate8->alc,
                    'bonus_date' => date('Y-m-d'),
                    'month' => date('m'),
                    'year' => date('Y')
                );
                DB::table('monthly_bonus')->insert($data);
                // add to wallet
                $cwallet = Helper::encryptor('decrypt', $m->cash_wallet) + $amount;
                DB::table('members')->where('id', $mid)->update(['cash_wallet'=>Helper::encryptor('encrypt', $cwallet)]);
              
                $data = array(
                    'member_id' => $mid,
                    'transaction_date' => date('Y-m-d'),
                    'amount' => $amount,
                    'wallet_type' => 'cwallet'
                );
                DB::table('bonus_earning_transactions')->insert($data);
                return $amount;
            }
            else{
                return 0;
            }
            
        }
        else{
            return $bonus->amount;
        }
    }

}