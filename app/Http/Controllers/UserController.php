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
            ->join('roles', 'users.role_id', 'roles.id')
            ->orderBy('users.id', 'desc')
            ->select('users.*', 'roles.name as rname')
            ->paginate(1);
        return view('admins.users.index', $data);
    }
    public function create()
    {
        $data['roles'] = DB::table('roles')->get();
        return view('admins.users.create', $data);
    }
    public function save(Request $r)
    {
        $data = array(
            'name' => $r->name,
            'email' => $r->email,
            'role_id' => $r->role,
            'password' => bcrypt($r->password)
        );
        // check if already have user
        $users = DB::table('users')->where('email', $r->email)->get();
        if(count($users)>0)
        {
            $r->session()->flash('sms1', 'User email already exist. Please use a different one!');
            return redirect('anana-admin/user/create')->withInput();
        }
        $i = DB::table('users')->insert($data);
        if($i)
        {
            $r->session()->flash('sms', 'New user has been created successfully!');
            return redirect('anana-admin/user/create');
        }
        else
        {
            $r->session()->flash('sms1', 'Fail to create new user. Please check your input again!');
            return redirect('anana-admin/user/create')->withInput();
        }
    }
    public function edit($id)
    {
        $dat['user'] = DB::table('user')->where('id', $id)->first();
        $data['roles'] = DB::table('roles')->get();
        return view('admins.users.edit', $data);
    }
    public function update(Request $r)
    {

    }
    public function delete(Request $r)
    {
        $page = $r->page;
        $id = $r->id;
        
    }
}
