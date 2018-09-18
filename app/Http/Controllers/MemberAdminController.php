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
        return view('admins.members.detail', $data);
    }
    public function delete($id, Request $r)
    {
        DB::table('members')->where('id', $id)->update(['active'=>0]);
        $r->session()->flash('sms', 'The member has been removed successfully!');
        return redirect('anana-admin/member');
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
                return redirect('anana-admin/member/reset-password/'.$id);
         }
         else{
             $data = array(
                 'password' => bcrypt($new_password)
             );
             $i = DB::table('members')->where('id', $id)->update($data);
             if($i) {
                 $r->session()->flash('sms',"Reset password successfully!");
             }
             return redirect('anana-admin/member/reset-password/'.$id);
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
            'security_pin' => $pin
        );
        $i = DB::table('members')->where('id', $id)->update($data);
        if($i) {
            $r->session()->flash('sms',"Reset security pin successfully!");
        } else {
        $r->session()->flash('sms1',"Fail to reset security pin, please check again.");
        }
        return redirect('anana-admin/member/reset-security-pin/'.$id);
      
      }
}
