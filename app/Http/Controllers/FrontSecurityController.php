<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontSecurityController extends Controller
{
    /**
     * Show the sign in front page
     *
     * @return \Illuminate\Http\Response
     */
    public function sign_in()
    {
        return view('fronts.sign-in');
    }
    
    /**
     * Show the sign up front page
     *
     * @return \Illuminate\Http\Response
     */
    public function sign_up(Request $r)
    {
        $data['sponsor_id'] = "";
        if($r->sponsor)
        {
           $data['sponsor_id'] = $_GET['sponsor'];
        }
        
        return view('fronts.sign-up', $data);
    }

    /**
     * Show the sign up front page
     *
     * @return \Illuminate\Http\Response
     */
    public function forget()
    {
        return view('fronts.forgot');
    }

    /**
     * Show the sign up front page
     *
     * @return \Illuminate\Http\Response
     */
    public function reset()
    {
        return view('fronts.reset');
    }
}
