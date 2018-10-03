<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
class InvestmentController extends Controller
{
    public function index($id)
    {
        $member = session('member');
        if($member==null)
        {
            return redirect('/sign-in');
        }
        // get investment
        $data['investment'] = DB::table('investments')
            ->join('packages', 'investments.package_id', 'packages.id')
            ->where('investments.member_id', $id)
            ->where('is_expired', 0)
            ->select('investments.order_date', 'packages.*')
            ->first();
        
        return view('fronts.members.investment', $data);
    }
    public function start()
    {
        $member = session('member');
        if($member==null)
        {
            return redirect('/sign-in');
        }
      
        $data['packages'] = DB::table('packages')->where('active', 1)->get();
        $data['member'] = DB::table('members')->where('id', $member->id)->first();
        return view('fronts.members.start-invest', $data);
    }
    // save investment
    public function save(Request $r)
    {
        $member = session('member');
        if($member==null)
        {
            return redirect('/sign-in');
        }
        $m = DB::table('members')->where('id', $member->id)->first();
        // check if user select a package or not
        $p = DB::table('packages')->where('id', $r->package)->first();
        if($p==null)
        {
            $r->session()->flash('sms1', 'Please choose a package!');
            return redirect('member/investment/start');
        }
        // check if R wallet has enough balance or not
        $rwallet = DB::table('members')->where('id', $member->id)->first();
        if($rwallet->register_wallet<$p->price)
        {
            $r->session()->flash('sms1', 'Your register wallet does not have enough balance!');
            return redirect('member/investment/start');
        }
        // check if security pin is correct
        if($r->pin!=$m->security_pin)
        {
            $r->session()->flash('sms1', 'Your security pin is not correct!');
            return redirect('member/investment/start');
        }

    }
}
