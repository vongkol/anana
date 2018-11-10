<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Right;
use DB;
use Auth;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data['trans'] = DB::table('member_earning_transactions')
            ->join('members', 'member_earning_transactions.member_id', 'members.id')
            ->join('packages', 'member_earning_transactions.package_id', 'packages.id')
            ->orderBy('member_earning_transactions.id', 'desc')
            ->select('member_earning_transactions.*', 'members.username', 'members.email', 'packages.name', 'packages.price')
            ->paginate(22);
        return view('admins.transactions.member-earning', $data);
    }
    public function transfer()
    {
        $data['trans'] = DB::table('member_transfer_transactions')
            ->join('members', 'member_transfer_transactions.from_id', 'members.id')
            ->orderBy('member_transfer_transactions.id', 'desc')
            ->select('member_transfer_transactions.*', 'members.username')
            ->paginate(22);
        return view('admins.transactions.member-transfer', $data);
    }
}
