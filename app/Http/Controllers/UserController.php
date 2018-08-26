<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
class UserController extends Controller
{
    
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        return redirect('/login');
    }
}
