<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class FrontController extends Controller
{
    public function index()
    {

    }
    public function investment()
    {
        $data['packages'] = DB::table('packages')->where('active', 1)->get();
        return view('fronts.investment', $data);

    }
}
