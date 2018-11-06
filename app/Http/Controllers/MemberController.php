<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
class MemberController extends Controller
{
   
    public function register(Request $r)
    {
         $validatedData = $r->validate([
            'full_name' => 'required',
            'email' => 'required|unique:members',
            'username' => 'required|min:3|max:30|unique:members',
            'password' => 'required|min:6',
            'security_pin' => 'required|min:4'
        ]);

        $sponsor = "";
        $m = DB::table('members')->where('username', $r->user)->first();
        
        if($r->password!=$r->cpassword)
        {
            $r->session()->flash('sms1', "The password and confirm password is not match!");
            return redirect('/sign-up')->withInput();
        }
        // check if sponsor has an investment
        $sp = DB::table('members')->where('username', $r->sponsor_id)->first();
        if($sp!=null)
        {
            $inv = DB::table('investments')->where('member_id', $sp->id)->first();
            if($inv!=null)
            {
                $sponsor = $r->sponsor_id;
            }
        }
        $data = array(
            'full_name' => $r->full_name,
            'email' => $r->email,
            'phone' => $r->phone,
            'email' => $r->email,
            'country' => $r->country,
            'username' => $r->username,
            'security_pin' => bcrypt($r->security_pin),
            'password' => bcrypt($r->password),
            'sponsor_id' => $sponsor
        );

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
        // DB::statement("UPDATE members set is_verified=1 where md5(id)='{$id}'");
        DB::table('members')->where(DB::raw('md5(id)'), $id)->update(['is_verified'=>1]);
        return redirect('/sign-in');
    }
    public function signin(Request $r)
    {
        // $validateData = $r->validate([
        //     'username' => 'required|min:3',
        //     'password' => 'required|min:6'
        // ]);
        $username = $r->username;
        $pass = $r->password;
        $member = DB::table('members')->where('active',1)->where('username', $username)->first();
      
        if($member!=null)
        {  
            if(password_verify($pass, $member->password) && $member->is_verified==1)
            {
                
                if($r->session()->get('member')!=NULL)
                {
                    $r->session()->forget('member');
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
        $data['id'] = Helper::encryptor('encrypt', $member->id);
        return view('fronts.members.dashboard', $data);
    }
    public function profile($id)
    {
        $member = session('member');
        if($member==null)
        {
            return redirect('/sign-in');
        }
        $data['profile'] = DB::table('members')->where('id', $id)->first();
        $data['countries'] = DB::table('countries')->get();
        return view('fronts.members.profile', $data);
    }
    public function my_account($id)
    {
        $member = session('member');
        if($member==null)
        {
            return redirect('/sign-in');
        }
        $id = Helper::encryptor("decrypt", $id);
        $data['account'] = DB::table('members')->where('id', $id)->first();
        $data['bank'] = DB::table('banks')->where('member_id', $id)->first();
        return view('fronts.members.account', $data);
    }


    /**
     * Show the sign up front page
     *
     * @return \Illuminate\Http\Response
     */
    public function recovery()
    {
        return view('fronts.members.recovery');
    }

    public function recovery_send_to_email(Request $r)
    {
        $member_email = $r->email;
        // check if email exist
        $result = DB::table("members")->where("email", $member_email)->first();
        if ($result!=null)
        {
            $id = md5($result->id);
            $i = Right::send_email($member_email, $id);
           
            DB::table("employees")->where("id", $result->id)->update(['is_verified'=>1]);
            return view("fronts.member.send-success");
        }
        else{
            if ($r->session()->get('lang')=='en') {
                $r->session()->flash("sms1", "Your email does not exist in our system!");
            } else {
                $r->session()->flash("sms1", "អុីម៉ែលរបស់អ្នកមិនមាននៅក្នុងប្រព័ន្ធយើងទេ!");
            }
            return redirect('/member/recovery')->withInput();
        }
    }
    // save address for bank
    public function save_address(Request $r)
    {
        $member = session('member');
        if($member==null)
        {
            return redirect('/sign-in');
        }
        $data = array(
            'member_id' => $member->id,
            'bank_name' => $r->bank_name,
            'full_name' => $r->full_name,
            'account_no' => $r->account_no,
            'branch_name' => $r->branch_name,
            'swift_code' => $r->swift_code,
            'address' => $r->address
        );
        DB::table('banks')->insert($data);
        return redirect('member/account/'. Helper::encryptor('encrypt', $member->id));
    }
    public function reset_password(Request $r)
    {
        $email = $r->email;

        $m = DB::table('members')->where('email', $email)->first();
        $id = Helper::encryptor('encrypt', $m->id);
        if($m!=null)
        {
            $sms =<<<EOT
                <h2>Reset Your Password</h2>
                <hr>
                <p>
                    Please click the link below to reset your password.
                </p>
                <p>
                    <a href="https://analeecapital.com/member/reset/{$id}" target="_blank">https://analeecapital.com/member/reset/{$id}</a>
                </p>
EOT;
                // send email confirmation
            Right::sms($r->email, $sms);
            $data['sms'] = 'Please check your email, we have sent you the reset password link.';
            return view('fronts.members.thank', $data);
        }
        else{
            $r->session()->flash('sms1', 'The email you provided does not exist.');
            return redirect('member/recovery');
        }
    }
    public function reset($id)
    {
        $data['id'] = $id;
        return view('fronts.members.reset', $data);
    }
    public function save_reset(Request $r)
    {
        $validateData = $r->validate([
            'password' => "required|min:6"
        ]);
        $id = Helper::encryptor('decrypt', $r->id);
        if($r->password!=$r->cpassword)
        {
            $r->session()->flash('sms1', 'The password and confirm password is not matched!');
            return redirect('member/reset/'.$r->id);
        }
        else{
            $data = array(
                'password' => bcrypt($r->password)
            );
            $i = DB::table('members')->where('id', $id)->update($data);
            $r->session()->flash('sms', 'Your pass word has been reset. Please login again!');
            return redirect('sign-in');
        }
    }
    public function change_password()
    {
        $member = session('member');
        if($member==null)
        {
            return redirect('/sign-in');
        }
        $data['id'] = Helper::encryptor('encrypt', $member->id);
        return view('fronts.members.change-password', $data);
    }
    public function change_password_save(Request $r)
    {
        $validateData = $r->validate([
            'password' => 'required|min:6'
        ]);
        $member = session('member');
        if($member==null)
        {
            return redirect('/sign-in');
        }
        $data['id'] = Helper::encryptor('encrypt', $member->id);
        $pass = $r->password;
        $cpass = $r->cpassword;
        if($pass!=$cpass)
        {
            $r->session()->flash('sms1', 'The password and confirm password is not matched!');
            return redirect('member/change-password')->withInput();
        }
        $data = array(
            'password' => bcrypt($pass)
        );
        DB::table('members')->where('id', $member->id)->update($data);
        $r->session()->flash('sms', 'Your password has been changed!');

        return redirect('member/change-password');
    }
     public function change_pin()
    {
        $member = session('member');
        if($member==null)
        {
            return redirect('/sign-in');
        }
        $data['id'] = Helper::encryptor('encrypt', $member->id);
        return view('fronts.members.change-pin', $data);
    }
    public function change_pin_save(Request $r)
    {
        $validateData = $r->validate([
            'security_pin' => 'required|min:4'
        ]);
        $member = session('member');
        if($member==null)
        {
            return redirect('/sign-in');
        }
        $data['id'] = Helper::encryptor('encrypt', $member->id);
        $pass = $r->security_pin;
        $cpass = $r->cpin;
        if($pass!=$cpass)
        {
            $r->session()->flash('sms1', 'The PIN and confirm PIN is not matched!');
            return redirect('member/change-pin')->withInput();
        }
        $data = array(
            'password' => bcrypt($pass)
        );
        DB::table('members')->where('id', $member->id)->update($data);
        $r->session()->flash('sms', 'Your security PIN has been changed!');

        return redirect('member/change-pin');
    }
}
