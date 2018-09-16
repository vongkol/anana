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
}
