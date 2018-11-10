<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Auth;
class SupplyController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }
    // index
    public function index()
    {
        if(!Right::check('Supply', 'l'))
        {
            return view('admins.permissions.no');
        }
        $data['supplies'] = DB::table('supplies')->paginate(18);
        return view('admins.supplies.index', $data);
    }

    public function edit($id)
    {
        if(!Right::check('Supply', 'u'))
        {
            return view('admins.permissions.no');
        }
        $data['supply'] = DB::table('supplies')->where('id', $id)->first();
        return view('admins.supplies.edit', $data);
    }

    public function update(Request $r)
    {
        if(!Right::check('Supply', 'u'))
        {
            return view('admins.permissions.no');
        }
        $data = [
            'title' => $r->title,
            'total_token' => $r->total_token
        ];
        $i = DB::table('supplies')->where('id', $r->id)->update($data);
        if($i)
        {
            $r->session()->flash('sms', "All changes have been saved successfully!");
            return redirect('analee-admin/supply/edit/'.$r->id);
        }
        else{
            $r->session()->flash('sms1', "Fail to save changes. You might not make any change!");
            return redirect('analee-admin/supply/edit/'.$r->id);
        }
    }
  
}
