<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Right;
use DB;
use Auth;
class EarningController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if(!Right::check('Total Earning', 'l'))
        {
            return view('admins.permissions.no');
        }
        $data['amount'] = DB::table('admin_earnings')->where('id', 1)->first();
        return view('admins.earnings.index', $data);
    }
}
