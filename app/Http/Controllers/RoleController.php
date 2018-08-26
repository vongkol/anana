<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Auth;
class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()==null)
            {
                return redirect("/login");
            }
            return $next($request);
        });
    }
    // index
    public function index()
    {
        // if(!Right::check('Role', 'l'))
        // {
        //     return view('permissions.no');
        // }
        $data['roles'] = DB::table('roles')->get();
        return view('admins.roles.index', $data);
    }
    public function create()
    {
        // if(!Right::check('Role', 'i'))
        // {
        //     return view('admins.permissions.no');
        // }
        return view('admins.roles.create');
    }
    public function save(Request $r)
    {
       
        $data = array(
            'name' => $r->name
        );
        $i = DB::table('roles')->insert($data);
        if($i)
        {
            $r->session()->flash('sms', "New role has been created successfully!");
            return redirect('anana-admin/role/create');
        }
        else{
            $r->session()->flash('sms1', "Fail to create new role. Please check your input again!");
            return redirect('anana-admin/role/create')->withInput();
        }
    }
    public function update(Request $r)
    {
        $data = array(
            'name' => $r->name
        );
        $i = DB::table('roles')->where('id', $r->id)->update($data);
        if($i)
        {
            $r->session()->flash('sms', "All changes have been saved successfully!");
            return redirect('anana-admin/role/edit/'.$r->id);
        }
        else{
            $r->session()->flash('sms1', "Fail to save changes. You might not make any change!");
            return redirect('anana-admin/role/edit/'.$r->id);
        }
    }
    public function edit($id)
    {
        // if(!Right::check('Role', 'u'))
        // {
        //     return view('permissions.no');
        // }
        $data['role'] = DB::table('roles')->where('id', $id)->first();
        return view('admins.roles.edit', $data);
    }
    // delete a role by id
    public function delete(Request $r)
    {
        // if(!Right::check('Role', 'd'))
        // {
        //     return view('permissions.no');
        // }
        DB::table('roles')->where('id', $r->id)->delete();
        $r->session()->flash('sms', 'A role has been removed successfully!');
        return redirect('anana-admin/role');
    }
}
