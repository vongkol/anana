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
        $data['members'] = DB::table('members')->where('active', 1)->orderBy('id', 'desc')->paginate(25);
        $data['total'] = DB::table('members')->where('active', 1)->count();
        return view('admins.members.index', $data);
    }
    public function detail($id)
    {
        $data['member'] = DB::table('members')->where('id', $id)->first();
        // get member investment
        $data['investment'] = DB::table('investments')
            ->join('packages','investments.package_id', 'packages.id')
            ->where('investments.member_id', $id)
            ->select('investments.*', 'packages.name', 'packages.price', 'packages.monthly_payout', 'packages.duration')
            ->first();
        return view('admins.members.detail', $data);
    }
    public function delete($id, Request $r)
    {
        DB::table('members')->where('id', $id)->update(['active'=>0]);
        $r->session()->flash('sms', 'The member has been removed successfully!');
        return redirect('analee-admin/member');
    }
     // load reset password form
     public function reset_password($id)
     {
        $data['member'] = DB::table('members')->where('id', $id)->first();
         return view('admins.members.reset-password', $data);
     }
 
     public function change_password(Request $r)
     {
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
         $data['member'] = DB::table('members')->where('id', $id)->first();
          return view('admins.members.reset-pin', $data);
      }
  
      public function change_pin(Request $r)
      {
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
      public function credit($id)
      {
          $data['member'] = DB::table('members')->where('id', $id)->first();
          return view('admins.members.credit', $data);
      }
      public function save_credit(Request $r)
      {
          $m = DB::table('members')->where('id', $r->id)->first();
          $r_wallet = $m->register_wallet + $r->credit;
          $data = array(
              'register_wallet' => $r_wallet
          );
          $i = DB::table('members')->where('id', $m->id)->update($data);
          if($i)
          {
              $dd = array(
                  'from_username' => Auth::user()->email,
                  'to_username' => $m->username,
                  'wallet_type' => 'register_wallet',
                  'amount' => $r_wallet,
                  'transfer_date' => date('Y-m-d')
              );
              DB::table('transfer_transactions')->insert($dd);
              $r->session()->flash('sms', 'Credit already transferred!');
              return redirect('analee-admin/member/credit/'.$m->id);
          }
          else{
              $r->session()->flash('sms1', 'Fail to transfer. Please check your input!');
              return redirect('analee-admin/member/credit/'.$m->id);
          }
      }
}
