<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class DashboardController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }
    public function index()
    {
        if(!Right::check('Dashboard', 'l'))
        {
            return view('admins.permissions.no');
        }
        return view('admins.dashboard');
    }
}
