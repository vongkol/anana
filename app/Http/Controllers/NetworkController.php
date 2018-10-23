<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class NetworkController extends Controller
{
    public function index()
    {
        $member = session('member');
        if($member==null)
        {
            return redirect('/sign-in');
        }

        $gen1 = [];
        $gen2 = [];
        $gen3 = [];
        $gen4 = [];
        $gen5 = [];
        $gen6 = [];

        // gen 1
        $g1 = DB::table('members')->where('sponsor_id', $member->username)->where('active', 1)->get();
        foreach($g1 as $g)
        {
            array_push($gen1, $g->username);

        }
        // gen 2
        foreach($gen1 as $g)
        {
            $g2 = DB::table('members')->where('sponsor_id', $g)->where('active', 1)->get();
            foreach($g2 as $gg)
            {
                array_push($gen2, $gg->username);
            }
        }
        // gen 3
        foreach($gen2 as $g)
        {
            $g3 = DB::table('members')->where('sponsore_id', $g)->where('active', 1)->get();
            foreach($g3 as $gg)
            {
                array_push($gen3, $gg->username);
            }
        }
        // gen 4
        foreach($gen3 as $g)
        {
            $g4 = DB::table('members')->where('sponsore_id', $g)->where('active', 1)->get();
            foreach($g4 as $gg)
            {
                array_push($gen4, $gg->username);
            }
        }
        // gen 5
        foreach($gen4 as $g)
        {
            $g5 = DB::table('members')->where('sponsore_id', $g)->where('active', 1)->get();
            foreach($g5 as $gg)
            {
                array_push($gen5, $gg->username);
            }
        }
        // gen 6
        foreach($gen5 as $g)
        {
            $g6 = DB::table('members')->where('sponsore_id', $g)->where('active', 1)->get();
            foreach($g6 as $gg)
            {
                array_push($gen6, $gg->username);
            }
        }
        $data['gen1'] = $gen1;
        $data['gen2'] = $gen2;
        $data['gen3'] = $gen3;
        $data['gen4'] = $gen4;
        $data['gen5'] = $gen5;
        $data['gen6'] = $gen6;
        return view('fronts.members.network', $data);
    }
}
