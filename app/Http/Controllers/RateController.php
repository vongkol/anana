<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class RateController extends Controller
{
    public function index()
    {
        $rate = DB::table('rates')->where('id',1)->first();
        return $rate->rate;
    }
}
