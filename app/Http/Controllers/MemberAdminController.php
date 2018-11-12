<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class MemberAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $r)
    {
        if(!Right::check('Member', 'l'))
        {
            return view('admins.permissions.no');
        }
        $data['members'] = DB::table('members')->where('active', 1)->orderBy('id', 'desc')->paginate(25);
        $data['total'] = DB::table('members')->where('active', 1)->count();
        return view('admins.members.index', $data);
    }
    public function detail($id)
    {
        if(!Right::check('Member', 'l'))
        {
            return view('admins.permissions.no');
        }
        $data['member'] = DB::table('members')->where('id', $id)->first();
        // get member investment
        $data['investment'] = DB::table('investments')
            ->join('packages','investments.package_id', 'packages.id')
            ->where('investments.member_id', $id)
            ->select('investments.*', 'packages.name', 'packages.price', 'packages.monthly_payout', 'packages.duration')
            ->first();
        $data['bank'] = DB::table('banks')->where('member_id', $id)->first();
        // get direct download with investment info
        $data['networks'] = DB::table('investments')
            ->leftJoin('members', 'investments.member_id', 'members.id')
            ->leftJoin('packages', 'investments.package_id', 'packages.id')
            ->where('members.sponsor_id', $data['member']->username)
            ->where('investments.is_expired',0)
            ->select('members.*', 'packages.price', 'packages.name')
            ->get();
        return view('admins.members.detail', $data);
    }
    public function delete($id, Request $r)
    {
        if(!Right::check('Member', 'd'))
        {
            return view('admins.permissions.no');
        }
        DB::table('members')->where('id', $id)->update(['active'=>0]);
        $r->session()->flash('sms', 'The member has been removed successfully!');
        return redirect('analee-admin/member');
    }
     // load reset password form
     public function reset_password($id)
     {
        if(!Right::check('Member', 'u'))
        {
            return view('admins.permissions.no');
        }
        $data['member'] = DB::table('members')->where('id', $id)->first();
         return view('admins.members.reset-password', $data);
     }
 
     public function change_password(Request $r)
     {
         if(!Right::check('Member', 'u'))
        {
            return view('admins.permissions.no');
        }
         $id = $r->id;
         $new_password = $r->new_password;
         $confirm_password = $r->confirm_password;
         if ($new_password!=$confirm_password)
         {
                $r->session()->flash('sms1',"The password is not matched, please check again.");
                return redirect('analee-admin/member/reset-password/'.$id);
         }
         else{
             $data = array(
                 'password' => bcrypt($new_password)
             );
             $i = DB::table('members')->where('id', $id)->update($data);
             if($i) {
                 $r->session()->flash('sms',"Reset password successfully!");
             }
             return redirect('analee-admin/member/reset-password/'.$id);
         }
     }
      // load reset password form
      public function reset_pin($id)
      {
          if(!Right::check('Member', 'u'))
        {
            return view('admins.permissions.no');
        }
         $data['member'] = DB::table('members')->where('id', $id)->first();
          return view('admins.members.reset-pin', $data);
      }
  
      public function change_pin(Request $r)
      {
        if(!Right::check('Member', 'u'))
        {
            return view('admins.permissions.no');
        }
            $id = $r->id;
            $pin = $r->pin;
            $data = array(
                'security_pin' => bcrypt($pin)
            );
            $i = DB::table('members')->where('id', $id)->update($data);
            if($i) {
                $r->session()->flash('sms',"Reset security pin successfully!");
            } else {
            $r->session()->flash('sms1',"Fail to reset security pin, please check again.");
            }
            return redirect('analee-admin/member/reset-security-pin/'.$id);
      
      }
      // add cridit to member
      public function credit($id)
      {
        if(!Right::check('Add Credit', 'l'))
        {
            return view('admins.permissions.no');
        }
          $data['member'] = DB::table('members')->where('id', $id)->first();
          return view('admins.members.credit', $data);
      }
      public function save_credit(Request $r)
      {
        if(!Right::check('Add Credit', 'i'))
        {
            return view('admins.permissions.no');
        }
          $m = DB::table('members')->where('id', $r->id)->first();
          $r_wallet = Helper::encryptor('decrypt', $m->register_wallet) + $r->credit;
          $data = array(
              'register_wallet' => Helper::encryptor('encrypt', $r_wallet)
          );
          $i = DB::table('members')->where('id', $m->id)->update($data);
          if($i)
          {
              $dd = array(
                  'from_username' => Auth::user()->email,
                  'to_username' => $m->username,
                  'wallet_type' => 'register_wallet',
                  'amount' => $r->credit,
                  'transfer_date' => date('Y-m-d')
              );
              DB::table('transfer_transactions')->insert($dd);

            // calculate admin earning
            $ad = DB::table('admin_earnings')->where('id', 1)->first();
            $total = $ad->earning + $r->credit;
            $data = array(
                'earning' => $total
            );
            DB::table('admin_earnings')->where('id', 1)->update($data);

            $data = array(
                'transaction_date' => date('Y-m-d'),
                'amount' => $r->credit,
                'member_id' => $m->id,
                'package_id' => 0,
                'description' => "Buy Investment"
            );
            DB::table('admin_earning_transactions')->insert($data);
              $r->session()->flash('sms', 'Credit already transferred!');
              return redirect('analee-admin/member/credit/'.$m->id);
          }
          else{
              $r->session()->flash('sms1', 'Fail to transfer. Please check your input!');
              return redirect('analee-admin/member/credit/'.$m->id);
          }
      }
    // sale volume
    public function volume($id)
    {
        if(!Right::check('Member', 'l'))
        {
            return view('admins.permissions.no');
        }
        $m = DB::table('members')->where('id', $id)->first();
        $data['m'] = $m;
        return view('admins.members.volume', $data);
    }
    public function volume_save(Request $r)
    {
        if(!Right::check('Member', 'u'))
        {
            return view('admins.permissions.no');
        }
        $data = array(
            'sale_volume' => $r->sale_volume,
            'sale_bonus' => $r->sale_bonus
        );
        DB::table('members')->where('id', $r->id)->update($data);
        return redirect('analee-admin/member/detail/'.$r->id);
    }
}
