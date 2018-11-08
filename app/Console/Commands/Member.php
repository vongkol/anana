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

        
    }

    
}
