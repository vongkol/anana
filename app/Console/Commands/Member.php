<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Helper;
use DB;
class Member extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'member:earning';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is used calculate reward earning monthly for member by payment schedule.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    // encrypt and decrypt function
    public function encryptor($action, $string) 
    {
        $output = false;

        $encrypt_method = "AES-256-CBC";

        // hash
        $key = 'rJ9Odqepu3h5qqhpSEERhM1K2iAiV6zw';
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = '71dd1c957d7bd7e1';

        //do the encyption given text/string/number
        if( $action == 'encrypt' ) {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        //$output = base64_encode($output);
        }
        else if( $action == 'decrypt' ){
            $output = openssl_decrypt($string, $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }
     // calculate bonus for the previous month
     // calculation is made on day 1 of the current month
    public function bonus($mid)
    {
        $wallet_rate = DB::table('wallet_rates')->where('id', 1)->first();

        $m = DB::table('members')->where('id', $mid)->first();
        // current date
        $year = date('Y');
        $month = date('m');
        $bm = $month - 1;
        // check if we already calculate
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
                    ->where('investments.member_id', $g->id)
                    ->where('investments.is_expired', 0)
                    ->select('packages.price')
                    ->first();
                if($inv!=null)
                {
                    $total = $total + $inv->price;
                }
            }
            $rate1 = DB::table('commission_plans')->where('id', 8)->first();
            $rate2 = DB::table('commission_plans')->where('id', 7)->first();
            $rate3 = DB::table('commission_plans')->where('id', 6)->first();
            $rate4 = DB::table('commission_plans')->where('id', 5)->first();
            $rate5 = DB::table('commission_plans')->where('id', 4)->first();
            $rate6 = DB::table('commission_plans')->where('id', 3)->first();
            $rate7 = DB::table('commission_plans')->where('id', 2)->first();
            $rate8 = DB::table('commission_plans')->where('id', 1)->first();
            // kind diamound
            
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
                // total bonus
                $total1 = $amount + $rate1->alc;
                // split to c_wallet, r_wallet, b_wallet and admin_fee
                $c_wallet = $total1*$wallet_rate->c_wallet;
                $r_wallet = $total1*$wallet_rate->r_wallet;
                $b_wallet = $total1*$wallet_rate->b_wallet;
                $admin_fee = $total1*$wallet_rate->admin_fee;
                $data = array(
                    'cash_wallet' => $this->encryptor('encrypt', $this->encryptor('decrypt', $m->cash_wallet) + $c_wallet),
                    'register_wallet' => $this->encryptor('encrypt', $this->encryptor('decrypt', $m->register_wallet) + $r_wallet),
                    'token_wallet' => $this->encryptor('encrypt', $this->encryptor('decrypt', $m->token_wallet) + $b_wallet)
                );

                DB::table('members')->where('id', $mid)->update($data);
                // transaction of cash wallet
                $data1 = array(
                    'member_id' => $mid,
                    'transaction_date' => date('Y-m-d'),
                    'amount' => $c_wallet,
                    'wallet_type' => 'C Wallet',
                    'description' => 'Matching Reward'
                );
                DB::table('bonus_earning_transactions')->insert($data1);
                // transaction of register wallet
                $data2 = array(
                    'member_id' => $mid,
                    'transaction_date' => date('Y-m-d'),
                    'amount' => $r_wallet,
                    'wallet_type' => 'R Wallet',
                    'description' => 'Matching Reward'
                );
                DB::table('bonus_earning_transactions')->insert($data2);
                // transaction of register wallet
                $data3 = array(
                    'member_id' => $mid,
                    'transaction_date' => date('Y-m-d'),
                    'amount' => $b_wallet,
                    'wallet_type' => 'B Wallet',
                    'description' => 'Matching Reward'
                );
                DB::table('bonus_earning_transactions')->insert($data3);
                // admin earning
                $ad = DB::table('admin_earnings')->where('id', 1)->first();
                $total = $ad->earning + $admin_fee;
                DB::table('admin_earnings')->where('id', 1)->update(['earning'=>$total]);
                $data = array(
                    'transaction_date' => date('Y-m-d'),
                    'amount' => $admin_fee,
                    'member_id' => $mid,
                    'package_id' => 0,
                    'description' => 'Matching Reward'
                );
                DB::table('admin_earning_transactions')->insert($data);
                DB::table('members')->where('id', $mid)->update(['photo'=>'8.png']);
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

                // total bonus
                $total2 = $amount + $rate2->alc;
                // split to c_wallet, r_wallet, b_wallet and admin_fee
                $c_wallet = $total2*$wallet_rate->c_wallet;
                $r_wallet = $total2*$wallet_rate->r_wallet;
                $b_wallet = $total2*$wallet_rate->b_wallet;
                $admin_fee = $total2*$wallet_rate->admin_fee;
                $data = array(
                    'cash_wallet' => $this->encryptor('encrypt', $this->encryptor('decrypt', $m->cash_wallet) + $c_wallet),
                    'register_wallet' => $this->encryptor('encrypt', $this->encryptor('decrypt', $m->register_wallet) + $r_wallet),
                    'token_wallet' => $this->encryptor('encrypt', $this->encryptor('decrypt', $m->token_wallet) + $b_wallet)
                );

                DB::table('members')->where('id', $mid)->update($data);
                // transaction of cash wallet
                $data1 = array(
                    'member_id' => $mid,
                    'transaction_date' => date('Y-m-d'),
                    'amount' => $c_wallet,
                    'wallet_type' => 'C Wallet',
                    'description' => 'Matching Reward'
                );
                DB::table('bonus_earning_transactions')->insert($data1);
                // transaction of register wallet
                $data2 = array(
                    'member_id' => $mid,
                    'transaction_date' => date('Y-m-d'),
                    'amount' => $r_wallet,
                    'wallet_type' => 'R Wallet',
                    'description' => 'Matching Reward'
                );
                DB::table('bonus_earning_transactions')->insert($data2);
                // transaction of register wallet
                $data3 = array(
                    'member_id' => $mid,
                    'transaction_date' => date('Y-m-d'),
                    'amount' => $b_wallet,
                    'wallet_type' => 'B Wallet',
                    'description' => 'Matching Reward'
                );
                DB::table('bonus_earning_transactions')->insert($data3);
                // admin earning
                $ad = DB::table('admin_earnings')->where('id', 1)->first();
                $total = $ad->earning + $admin_fee;
                DB::table('admin_earnings')->where('id', 1)->update(['earning'=>$total]);
                $data = array(
                    'transaction_date' => date('Y-m-d'),
                    'amount' => $admin_fee,
                    'member_id' => $mid,
                    'package_id' => 0,
                    'description' => 'Matching Reward'
                );
                DB::table('admin_earning_transactions')->insert($data);

                DB::table('members')->where('id', $mid)->update(['photo'=>'7.png']);
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
                
                // total bonus
                $total3 = $amount + $rate3->alc;
                // split to c_wallet, r_wallet, b_wallet and admin_fee
                $c_wallet = $total3*$wallet_rate->c_wallet;
                $r_wallet = $total3*$wallet_rate->r_wallet;
                $b_wallet = $total3*$wallet_rate->b_wallet;
                $admin_fee = $total3*$wallet_rate->admin_fee;
                $data = array(
                    'cash_wallet' => $this->encryptor('encrypt', $this->encryptor('decrypt', $m->cash_wallet) + $c_wallet),
                    'register_wallet' => $this->encryptor('encrypt', $this->encryptor('decrypt', $m->register_wallet) + $r_wallet),
                    'token_wallet' => $this->encryptor('encrypt', $this->encryptor('decrypt', $m->token_wallet) + $b_wallet)
                );

                DB::table('members')->where('id', $mid)->update($data);
                // transaction of cash wallet
                $data1 = array(
                    'member_id' => $mid,
                    'transaction_date' => date('Y-m-d'),
                    'amount' => $c_wallet,
                    'wallet_type' => 'C Wallet',
                    'description' => 'Matching Reward'
                );
                DB::table('bonus_earning_transactions')->insert($data1);
                // transaction of register wallet
                $data2 = array(
                    'member_id' => $mid,
                    'transaction_date' => date('Y-m-d'),
                    'amount' => $r_wallet,
                    'wallet_type' => 'R Wallet',
                    'description' => 'Matching Reward'
                );
                DB::table('bonus_earning_transactions')->insert($data2);
                // transaction of register wallet
                $data3 = array(
                    'member_id' => $mid,
                    'transaction_date' => date('Y-m-d'),
                    'amount' => $b_wallet,
                    'wallet_type' => 'B Wallet',
                    'description' => 'Matching Reward'
                );
                DB::table('bonus_earning_transactions')->insert($data3);
                // admin earning
                $ad = DB::table('admin_earnings')->where('id', 1)->first();
                $total = $ad->earning + $admin_fee;
                DB::table('admin_earnings')->where('id', 1)->update(['earning'=>$total]);
                $data = array(
                    'transaction_date' => date('Y-m-d'),
                    'amount' => $admin_fee,
                    'member_id' => $mid,
                    'package_id' => 0,
                    'description' => 'Matching Reward'
                );
                DB::table('admin_earning_transactions')->insert($data);

                DB::table('members')->where('id', $mid)->update(['photo'=>'6.png']);
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
                
                // total bonus
                $total4 = $amount + $rate4->alc;
                // split to c_wallet, r_wallet, b_wallet and admin_fee
                $c_wallet = $total4*$wallet_rate->c_wallet;
                $r_wallet = $total4*$wallet_rate->r_wallet;
                $b_wallet = $total4*$wallet_rate->b_wallet;
                $admin_fee = $total4*$wallet_rate->admin_fee;
                $data = array(
                    'cash_wallet' => $this->encryptor('encrypt', $this->encryptor('decrypt', $m->cash_wallet) + $c_wallet),
                    'register_wallet' => $this->encryptor('encrypt', $this->encryptor('decrypt', $m->register_wallet) + $r_wallet),
                    'token_wallet' => $this->encryptor('encrypt', $this->encryptor('decrypt', $m->token_wallet) + $b_wallet)
                );

                DB::table('members')->where('id', $mid)->update($data);
                // transaction of cash wallet
                $data1 = array(
                    'member_id' => $mid,
                    'transaction_date' => date('Y-m-d'),
                    'amount' => $c_wallet,
                    'wallet_type' => 'C Wallet',
                    'description' => 'Matching Reward'
                );
                DB::table('bonus_earning_transactions')->insert($data1);
                // transaction of register wallet
                $data2 = array(
                    'member_id' => $mid,
                    'transaction_date' => date('Y-m-d'),
                    'amount' => $r_wallet,
                    'wallet_type' => 'R Wallet',
                    'description' => 'Matching Reward'
                );
                DB::table('bonus_earning_transactions')->insert($data2);
                // transaction of register wallet
                $data3 = array(
                    'member_id' => $mid,
                    'transaction_date' => date('Y-m-d'),
                    'amount' => $b_wallet,
                    'wallet_type' => 'B Wallet',
                    'description' => 'Matching Reward'
                );
                DB::table('bonus_earning_transactions')->insert($data3);
                // admin earning
                $ad = DB::table('admin_earnings')->where('id', 1)->first();
                $total = $ad->earning + $admin_fee;
                DB::table('admin_earnings')->where('id', 1)->update(['earning'=>$total]);
                $data = array(
                    'transaction_date' => date('Y-m-d'),
                    'amount' => $admin_fee,
                    'member_id' => $mid,
                    'package_id' => 0,
                    'description' => 'Matching Reward'
                );
                DB::table('admin_earning_transactions')->insert($data);

                DB::table('members')->where('id', $mid)->update(['photo'=>'5.png']);
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
                
                // total bonus
                $total5 = $amount + $rate5->alc;
                // split to c_wallet, r_wallet, b_wallet and admin_fee
                $c_wallet = $total5*$wallet_rate->c_wallet;
                $r_wallet = $total5*$wallet_rate->r_wallet;
                $b_wallet = $total5*$wallet_rate->b_wallet;
                $admin_fee = $total5*$wallet_rate->admin_fee;
                $data = array(
                    'cash_wallet' => $this->encryptor('encrypt', $this->encryptor('decrypt', $m->cash_wallet) + $c_wallet),
                    'register_wallet' => $this->encryptor('encrypt', $this->encryptor('decrypt', $m->register_wallet) + $r_wallet),
                    'token_wallet' => $this->encryptor('encrypt', $this->encryptor('decrypt', $m->token_wallet) + $b_wallet)
                );

                DB::table('members')->where('id', $mid)->update($data);
                // transaction of cash wallet
                $data1 = array(
                    'member_id' => $mid,
                    'transaction_date' => date('Y-m-d'),
                    'amount' => $c_wallet,
                    'wallet_type' => 'C Wallet',
                    'description' => 'Matching Reward'
                );
                DB::table('bonus_earning_transactions')->insert($data1);
                // transaction of register wallet
                $data2 = array(
                    'member_id' => $mid,
                    'transaction_date' => date('Y-m-d'),
                    'amount' => $r_wallet,
                    'wallet_type' => 'R Wallet',
                    'description' => 'Matching Reward'
                );
                DB::table('bonus_earning_transactions')->insert($data2);
                // transaction of register wallet
                $data3 = array(
                    'member_id' => $mid,
                    'transaction_date' => date('Y-m-d'),
                    'amount' => $b_wallet,
                    'wallet_type' => 'B Wallet',
                    'description' => 'Matching Reward'
                );
                DB::table('bonus_earning_transactions')->insert($data3);
                // admin earning
                $ad = DB::table('admin_earnings')->where('id', 1)->first();
                $total = $ad->earning + $admin_fee;
                DB::table('admin_earnings')->where('id', 1)->update(['earning'=>$total]);
                $data = array(
                    'transaction_date' => date('Y-m-d'),
                    'amount' => $admin_fee,
                    'member_id' => $mid,
                    'package_id' => 0,
                    'description' => 'Matching Reward'
                );
                DB::table('admin_earning_transactions')->insert($data);

                DB::table('members')->where('id', $mid)->update(['photo'=>'4.png']);
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
               
                // total bonus
                $total6 = $amount + $rate6->alc;
                // split to c_wallet, r_wallet, b_wallet and admin_fee
                $c_wallet = $total6*$wallet_rate->c_wallet;
                $r_wallet = $total6*$wallet_rate->r_wallet;
                $b_wallet = $total6*$wallet_rate->b_wallet;
                $admin_fee = $total6*$wallet_rate->admin_fee;
                $data = array(
                    'cash_wallet' => $this->encryptor('encrypt', $this->encryptor('decrypt', $m->cash_wallet) + $c_wallet),
                    'register_wallet' => $this->encryptor('encrypt', $this->encryptor('decrypt', $m->register_wallet) + $r_wallet),
                    'token_wallet' => $this->encryptor('encrypt', $this->encryptor('decrypt', $m->token_wallet) + $b_wallet)
                );

                DB::table('members')->where('id', $mid)->update($data);
                // transaction of cash wallet
                $data1 = array(
                    'member_id' => $mid,
                    'transaction_date' => date('Y-m-d'),
                    'amount' => $c_wallet,
                    'wallet_type' => 'C Wallet',
                    'description' => 'Matching Reward'
                );
                DB::table('bonus_earning_transactions')->insert($data1);
                // transaction of register wallet
                $data2 = array(
                    'member_id' => $mid,
                    'transaction_date' => date('Y-m-d'),
                    'amount' => $r_wallet,
                    'wallet_type' => 'R Wallet',
                    'description' => 'Matching Reward'
                );
                DB::table('bonus_earning_transactions')->insert($data2);
                // transaction of register wallet
                $data3 = array(
                    'member_id' => $mid,
                    'transaction_date' => date('Y-m-d'),
                    'amount' => $b_wallet,
                    'wallet_type' => 'B Wallet',
                    'description' => 'Matching Reward'
                );
                DB::table('bonus_earning_transactions')->insert($data3);
                // admin earning
                $ad = DB::table('admin_earnings')->where('id', 1)->first();
                $total = $ad->earning + $admin_fee;
                DB::table('admin_earnings')->where('id', 1)->update(['earning'=>$total]);
                $data = array(
                    'transaction_date' => date('Y-m-d'),
                    'amount' => $admin_fee,
                    'member_id' => $mid,
                    'package_id' => 0,
                    'description' => 'Matching Reward'
                );
                DB::table('admin_earning_transactions')->insert($data);
                
                DB::table('members')->where('id', $mid)->update(['photo'=>'3.png']);
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
               
                // total bonus
                $total7 = $amount + $rate7->alc;
                // split to c_wallet, r_wallet, b_wallet and admin_fee
                $c_wallet = $total7*$wallet_rate->c_wallet;
                $r_wallet = $total7*$wallet_rate->r_wallet;
                $b_wallet = $total7*$wallet_rate->b_wallet;
                $admin_fee = $total7*$wallet_rate->admin_fee;
                $data = array(
                    'cash_wallet' => $this->encryptor('encrypt', $this->encryptor('decrypt', $m->cash_wallet) + $c_wallet),
                    'register_wallet' => $this->encryptor('encrypt', $this->encryptor('decrypt', $m->register_wallet) + $r_wallet),
                    'token_wallet' => $this->encryptor('encrypt', $this->encryptor('decrypt', $m->token_wallet) + $b_wallet)
                );

                DB::table('members')->where('id', $mid)->update($data);
                // transaction of cash wallet
                $data1 = array(
                    'member_id' => $mid,
                    'transaction_date' => date('Y-m-d'),
                    'amount' => $c_wallet,
                    'wallet_type' => 'C Wallet',
                    'description' => 'Matching Reward'
                );
                DB::table('bonus_earning_transactions')->insert($data1);
                // transaction of register wallet
                $data2 = array(
                    'member_id' => $mid,
                    'transaction_date' => date('Y-m-d'),
                    'amount' => $r_wallet,
                    'wallet_type' => 'R Wallet',
                    'description' => 'Matching Reward'
                );
                DB::table('bonus_earning_transactions')->insert($data2);
                // transaction of register wallet
                $data3 = array(
                    'member_id' => $mid,
                    'transaction_date' => date('Y-m-d'),
                    'amount' => $b_wallet,
                    'wallet_type' => 'B Wallet',
                    'description' => 'Matching Reward'
                );
                DB::table('bonus_earning_transactions')->insert($data3);
                // admin earning
                $ad = DB::table('admin_earnings')->where('id', 1)->first();
                $total = $ad->earning + $admin_fee;
                DB::table('admin_earnings')->where('id', 1)->update(['earning'=>$total]);
                $data = array(
                    'transaction_date' => date('Y-m-d'),
                    'amount' => $admin_fee,
                    'member_id' => $mid,
                    'package_id' => 0,
                    'description' => 'Matching Reward'
                );
                DB::table('admin_earning_transactions')->insert($data);

                DB::table('members')->where('id', $mid)->update(['photo'=>'2.png']);
                return $amount;
            }
            // star
            else if(count($gens)>=$rate8->direct_sponsor && $total>=$rate8->sale)
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
                
                // total bonus
                $total8 = $amount + $rate8->alc;
                // split to c_wallet, r_wallet, b_wallet and admin_fee
                $c_wallet = $total8*$wallet_rate->c_wallet;
                $r_wallet = $total8*$wallet_rate->r_wallet;
                $b_wallet = $total8*$wallet_rate->b_wallet;
                $admin_fee = $total8*$wallet_rate->admin_fee;
                $data = array(
                    'cash_wallet' => $this->encryptor('encrypt', $this->encryptor('decrypt', $m->cash_wallet) + $c_wallet),
                    'register_wallet' => $this->encryptor('encrypt', $this->encryptor('decrypt', $m->register_wallet) + $r_wallet),
                    'token_wallet' => $this->encryptor('encrypt', $this->encryptor('decrypt', $m->token_wallet) + $b_wallet)
                );

                DB::table('members')->where('id', $mid)->update($data);
                // transaction of cash wallet
                $data1 = array(
                    'member_id' => $mid,
                    'transaction_date' => date('Y-m-d'),
                    'amount' => $c_wallet,
                    'wallet_type' => 'C Wallet',
                    'description' => 'Matching Reward'
                );
                DB::table('bonus_earning_transactions')->insert($data1);
                // transaction of register wallet
                $data2 = array(
                    'member_id' => $mid,
                    'transaction_date' => date('Y-m-d'),
                    'amount' => $r_wallet,
                    'wallet_type' => 'R Wallet',
                    'description' => 'Matching Reward'
                );
                DB::table('bonus_earning_transactions')->insert($data2);
                // transaction of register wallet
                $data3 = array(
                    'member_id' => $mid,
                    'transaction_date' => date('Y-m-d'),
                    'amount' => $b_wallet,
                    'wallet_type' => 'B Wallet',
                    'description' => 'Matching Reward'
                );
                DB::table('bonus_earning_transactions')->insert($data3);
                // admin earning
                $ad = DB::table('admin_earnings')->where('id', 1)->first();
                $total = $ad->earning + $admin_fee;
                DB::table('admin_earnings')->where('id', 1)->update(['earning'=>$total]);
                $data = array(
                    'transaction_date' => date('Y-m-d'),
                    'amount' => $admin_fee,
                    'member_id' => $mid,
                    'package_id' => 0,
                    'description' => 'Matching Reward'
                );
                DB::table('admin_earning_transactions')->insert($data);

                DB::table('members')->where('id', $mid)->update(['photo'=>'1.png']);

                return $amount;
            }
            else{
                $data = array(
                    'member_id' => $mid,
                    'amount' => 0,
                    'alc' => 0,
                    'bonus_date' => date('Y-m-d'),
                    'month' => date('m'),
                    'year' => date('Y')
                );
                DB::table('monthly_bonus')->insert($data);
                DB::table('members')->where('id', $mid)->update(['photo'=>'0.png']);
                return 0;
            }
        }
        else{
            return $bonus->amount;
        }
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // calculate earning everyday for member with active investment

        // get all payment schedule need to pay today and not yet paid
        $pays = DB::table('payment_schedules')
            ->where('pay_date', date('Y-m-d'))
            ->where('is_paid', 0)
            ->get();
        foreach($pays as $pay)
        {
            // calcuate rate, 50% for c_wallet, 30% for r_wallet, 10% for admin_fee, 10% for b_wallet
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
                'member_id' => $pay->member_id,
                'package_id' => $pay->package_id
            );
            DB::table('admin_earning_transactions')->insert($data);
            // end admin earning

             // member earning transaction
            $m = DB::table('members')->where('id', $pay->member_id)->first();
            $c = $this->encryptor('decrypt', $m->cash_wallet) + $c_wallet;
            $r = $this->encryptor('decrypt', $m->register_wallet) + $r_wallet;
            $t = $this->encryptor('decrypt', $m->token_wallet) + $t_wallet;
            $data = array(
                'cash_wallet' => $this->encryptor('encrypt', $c),
                'register_wallet' => $this->encryptor('encrypt', $r),
                'token_wallet' => $this->encryptor('encrypt', $t)
            );
            DB::table('members')->where('id', $m->id)->update($data);

            DB::table('payment_schedules')->where('id', $pay->id)->update(['is_paid'=>1]);
            //save transaction
            $data = array(
                'member_id' => $m->id,
                'transaction_date' => date('Y-m-d'),
                'amount' => $c_wallet,
                'package_id' => $pay->package_id,
                'wallet_type' => 'cash wallet'
            );
            DB::table('member_earning_transactions')->insert($data);
            $data = array(
                'member_id' => $m->id,
                'transaction_date' => date('Y-m-d'),
                'amount' => $r_wallet,
                'package_id' => $pay->package_id,
                'wallet_type' => 'register wallet'
            );
            DB::table('member_earning_transactions')->insert($data);
            $data = array(
                'member_id' => $pay->member_id,
                'transaction_date' => date('Y-m-d'),
                'amount' => $t_wallet,
                'package_id' => $pay->package_id,
                'wallet_type' => 'token wallet'
            );
            DB::table('member_earning_transactions')->insert($data);

        }
        
        // get all expired investment and update it status
        $today = date('Y-m-d');
        $yesterday = date('Y-m-d', strtotime($today . "- 1 day"));
        $invs = DB::table('investments')
            ->where('is_expired', 0)
            ->where('expired_on', $yesterday)
            ->get();
        foreach($invs as $inv)
        {
            DB::table('investments')->where('id', $inv->id)->update(['is_expired'=>1]);
        }
        // get all members and find bonus for them
        $day = date('d');
        if($day==1)
        {
            $members = DB::table('investments')
            ->where('is_expired', 0)
            ->get();
            foreach($members as $m)
            {
                $this->bonus($m->id);
            }
        }
        
    }

    
}
