<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
class MemberController extends Controller
{
    public function Register(Request $r)
    {
        $data = array(
            'first_name' => $r->first_name,
            'last_name' => $r->last_name,
            'gender' => $r->gender,
            'email' => $r->email,
            'phone' => $r->phone,
            'country' => $r->country,
            'city' => $r->city,
            'password' => bcrypt($r->password)
        );

        if(session('ref')!=null)
        {
            $data['referal'] = session('ref');
        }
        $m = DB::table('members')->where('email', $r->email)->first();
        if($m!=null)
        {
            $r->session()->flash('sms1', 'The email is already in used. Please use a different one!');
            return redirect('/sign-up')->withInput();
        }
        if(!$r->agree)
        {
            $r->session()->flash('sms1', 'Please accept the license agreement!');
            return redirect('/sign-up')->withInput();
        }
        if($r->password!=$r->cpassword)
        {
            $r->session()->flash('sms1', 'The password and confirm password is not matched!');
            return redirect('/sign-up')->withInput();
        }
        if (!filter_var($r->email, FILTER_VALIDATE_EMAIL)) {
            $r->session()->flash('sms1', "Your email is invalid. Check it again!");
            return redirect('/sign-up')->withInput();
        }

        $i = DB::table('members')->insertGetId($data);
        
        if($i)
        {
            $link = url('/confirm') .'/'.md5($i);
               
                $sms =<<<EOT
                <h2>Sign Up Verification</h2>
                <hr>
                <p>
                    Please click the link below to verify your registration.
                </p>
                <p>
                    <a href="{$link}" target="_blank">{$link}</a>
                </p>
EOT;
                // send email confirmation
                Right::sms($r->email, $sms);
                return view('fronts.confirm');
        }
        else{
            $r->session()->flash('sms1', 'Fail to sign you up, please check your input again!');
            return redirect('/sign-up')->withInput();
        }
    }
    public function confirm($id)
    {
        DB::statement("UPDATE members set is_verified=1 where md5(id)='{$id}'");
        return redirect('/sign-in');
    }
    public function signin(Request $r)
    {
        $username = $r->email;
        $pass = $r->password;
        $member = DB::table('members')->where('active',1)->where('email', $username)->first();
      
        if($member!=null)
        {  
            if(password_verify($pass, $member->password) && $member->is_verified==1)
            {
              
                
                if($r->session()->get('member')!=NULL)
                {
                    $r->session()->forget('membership');
                    $r->session()->flush();
                }
                // save user to session
                $r->session()->put('member', $member);
              
                return redirect('/dashboard');
            }
            else{
                $r->session()->flash('sms1', "Invalid email or password. Try again!");
                return redirect('/sign-in')->withInput();
            }
        }
        else{
            $r->session()->flash('sms1', "Invalid email or password!");
            return redirect('/sign-in')->withInput();
        }
    }
    public function logout(Request $r)
    {
        $r->session()->forget('member');
        $r->session()->flush();
        return redirect('/');
    }
    public function dashboard(Request $r)
    {
        $member = $r->session()->get('member');
        if($member==null)
        {
            return redirect('/sign-in');
        }

        return view('fronts.members.dashboard');
    }
    public function profile($id)
    {
        $data['profile'] = DB::table('members')->where('id', $id)->first();
        $data['countries'] = DB::table('countries')->get();
        return view('fronts.members.profile', $data);
    }
}
