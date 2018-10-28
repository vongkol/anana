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
        $data['m'] = DB::table('members')->where('id', $member->id)->first();

        return view('fronts.members.network', $data);
    }
}
