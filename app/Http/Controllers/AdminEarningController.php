<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class AdminEarningController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data['total1'] = DB::table('admin_earnings')->sum('earning');
        $data['total2'] = DB::table('admin_earning_fees')->sum('earning');
        
    }
}
