<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class NetworkController extends Controller
{
    public function index()
    {
        $member = session('member');
        if($member==null)
        {
            return redirect('/sign-in');
        }
        $inv = DB::table('investments')->where('member_id', $member->id)->first();
        if($inv==null)
        {
            return redirect('member/investment/'. Helper::encryptor("encrypt", $member->id));
        }
        $data['m'] = DB::table('members')->where('id', $member->id)->first();

        return view('fronts.members.network', $data);
    }
}
