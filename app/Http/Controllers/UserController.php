<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use DB;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        return redirect('/anana-admin/login');
    }
    public function index()
    {
        $data['users'] = DB::table('users')
            ->orderBy('id', 'desc')
            ->paginate(18);
        return view('admins.users.index', $data);
    }
}
