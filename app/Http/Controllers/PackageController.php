<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class PackageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data['packages'] = DB::table('packages')->where('active', 1)->paginate(18);
        return view('admins.packages.index', $data);
    }
    public function create()
    {
        return view('admins.packages.create');
    }
    public function save(Request $r)
    {
        $data = array(
            'name' => $r->name,
            'price' => $r->price,
            'monthly_payout' => $r->monthly_payout,
            'duration' => $r->duration
        );
        $i = DB::table('packages')->insert($data);
        if($i)
        {
            $r->session()->flash('sms', 'New package has been created successfully!');
            return redirect('/analee-admin/package/create');
        }
        else
        {
            $r->session()->flash('sms1', 'Fail to create a new package. Please check your input again!');
            return redirect('/analee-admin/package/create')->withInput();
        }
    }
    public function update(Request $r)
    {
        $data = array(
            'name' => $r->name,
            'price' => $r->price,
            'monthly_payout' => $r->monthly_payout,
            'duration' => $r->duration
        );
        $i = DB::table('packages')->where('id', $r->id)->update($data);
        if($i)
        {
            $r->session()->flash('sms', 'All changes have been saved!');
            return redirect('/analee-admin/package/edit/'.$r->id);
        }
        else
        {
            $r->session()->flash('sms1', 'Fail to save changes. You might not make any change!');
            return redirect('/analee-admin/package/edit/'.$r->id);
        }
    }
    public function delete(Request $r)
    {
        DB::table('packages')->where('id', $r->id)->update(['active'=>0]);
        $r->session()->flash('sms', 'A package has been removed successfully!');
        return redirect('analee-admin/package');
    }
    public function edit($id)
    {
        $data['package'] = DB::table('packages')->where('id', $id)->first();
        return view('admins.packages.edit', $data);
    }
}
