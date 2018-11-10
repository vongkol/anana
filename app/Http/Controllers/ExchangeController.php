<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class ExchangeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if(!Right::check('Exchange', 'l'))
        {
            return view('admins.permissions.no');
        }
        $data['excs'] = DB::table('exchanges')->paginate(18);
        return view('admins.exchanges.index', $data);
    }
    public function create()
    {
        if(!Right::check('Exchange', 'i'))
        {
            return view('admins.permissions.no');
        }
        return view('admins.exchanges.create');
    }
    public function edit($id)
    {
        if(!Right::check('Exchange', 'u'))
        {
            return view('admins.permissions.no');
        }
        $data['exc'] = DB::table('exchanges')->where('id', $id)->first();
        return view('admins.exchanges.edit', $data);
    }
    public function save(Request $r)
    {
        if(!Right::check('Exchange', 'i'))
        {
            return view('admins.permissions.no');
        }
        $data = array(
            'currency' => $r->currency,
            'rate' => $r->rate
        );
        $i = DB::table('exchanges')->insert($data);
        if($i)
        {
            $r->session()->flash('sms', 'New exchange has been created successfully!');
            return redirect('analee-admin/exchange/create');
        }
        else{
            $r->session()->flash('sms1', 'Fail create new exchange. Please check your input again!');
            return redirect('analee-admin/exchange/create')->withInput();
        }
    }
    public function delete(Request $r)
    {
        if(!Right::check('Exchange', 'd'))
        {
            return view('admins.permissions.no');
        }
        DB::table('exchanges')->where('id', $r->id)->delete();
        $r->session()->flash('sms', 'An exchange has been removed successfully!');
        return redirect('analee-admin/exchange');
    }
    public function update(Request $r)
    {
        if(!Right::check('Exchange', 'u'))
        {
            return view('admins.permissions.no');
        }
        $data = array(
            'currency' => $r->currency,
            'rate' => $r->rate
        );
        $i = DB::table('exchanges')->where('id', $r->id)->update($data);
        if($i)
        {
            $r->session()->flash('sms', 'All changes have been saved!');
            return redirect('analee-admin/exchange/edit/'.$r->id);
        }
        else{
            $r->session()->flash('sms1', 'Fail to save changes. You might not make any change!');
            return redirect('analee-admin/exchange/edit/'.$r->id);
        }
    }
}
