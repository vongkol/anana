<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function contact()
    {
        return view('pages.contact');
    }
    public function about()
    {
        return view('pages.about');
    }
    public function white_paper()
    {
        return view('pages.white-paper');
    }
    public function private()
    {
        return view('pages.private');
    }
}
