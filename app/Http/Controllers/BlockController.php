<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class BlockController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if(!Right::check('Block', 'l'))
        {
            return view('admins.permissions.no');
        }
        $data['blocks'] = DB::table('blocks')->where('active', 1)->paginate(18);
        return view('admins.blocks.index', $data);
    }
    public function create()
    {
        if(!Right::check('Block', 'i'))
        {
            return view('admins.permissions.no');
        }
        return view('admins.blocks.create');
    }
    public function save(Request $r)
    {
       if(!Right::check('Block', 'i'))
        {
            return view('admins.permissions.no');
        }
        $data = array(
            'title' => $r->title,
            'total_token' => $r->total_token,
            'balance' => $r->total_token
        );
        $i = DB::table('blocks')->insert($data);
        if($i)
        {
            $r->session()->flash('sms', "New block has been created successfully!");
            return redirect('analee-admin/block/create');
        }
        else{
            $r->session()->flash('sms1', "Fail to create new block. Please check your input again!");
            return redirect('analee-admin/block/create')->withInput();
        }
    }
    public function delete(Request $r)
    {
        if(!Right::check('Block', 'd'))
        {
            return view('admins.permissions.no');
        }
        DB::table('blocks')->where('id', $r->id)->update(['active'=>0]);
        $r->session()->flash('sms', 'A block has been removed successfully!');
        return redirect('analee-admin/block');
    }
    public function edit($id)
    {
        if(!Right::check('Block', 'u'))
        {
            return view('admins.permissions.no');
        }
        $data['block'] = DB::table('blocks')->where('id', $id)->first();
        return view('admins.blocks.edit', $data);
    }
    public function update(Request $r)
    {
        if(!Right::check('Block', 'u'))
        {
            return view('admins.permissions.no');
        }
        $old_block = DB::table('blocks')->where('id', $r->id)->first();
        $old_value = $old_block->total_token;
        $new_value = $r->total_token;

        // calculate the diff
        $diff = $new_value - $old_value;
        // update database
        $data = array(
            'title' => $r->title,
            'total_token' => ($old_block->total_token + $diff),
            'balance' => ($old_block->balance + $diff)
        );
        $i = DB::table('blocks')->where('id', $r->id)->update($data);
        if($i)
        {
            $r->session()->flash('sms', 'All changes have saved!');
            return redirect('/analee-admin/block/edit/'.$r->id);
        }
        else
        {
            $r->session()->flash('sms1', 'Fail to save changes. You might not change anything!');
            return redirect('/analee-admin/block/edit/'.$r->id);
        }
    }
}
