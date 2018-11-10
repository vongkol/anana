<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Right;
use DB;
use Auth;
class CreditController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if(!Right::check('Credit Transaction', 'l'))
        {
            return view('admins.permissions.no');
        }
        $data['trans'] = DB::table('transfer_transactions')
            ->orderBy('id', 'desc')
            ->paginate(22);
        return view('admins.transactions.index', $data);
    }
}
