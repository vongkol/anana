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
}
