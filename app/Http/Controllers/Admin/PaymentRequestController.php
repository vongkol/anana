<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
class PaymentRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data['payments'] = DB::table('payment_requests')
            ->join('members', 'payment_requests.member_id', 'members.id')
            ->orderBy('payment_requests.id', 'desc')
            ->select('payment_requests.*', 'members.username', 'members.email')
            ->paginate(22);
        return view('admins.payments.index', $data);
    }
}
