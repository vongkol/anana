@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <h3 class="page-header">
            <div class="row">
                <div class="col-sm-5">
                    <i class="fa fa-user"></i> Member Detail 
                    <a href="{{url('analee-admin/member')}}" class="btn btn-success btn-xs"><i class="fa fa-arrow-left"></i> Back</a>
                </div>
                <div class="col-sm-7">
                    <form action="#">
                        <input type="text" placeholder="search...">
                        <button>Search</button>
                    </form>
                </div>
            </div>
            
        </h3>
    </div>
</div>
<div class="row">
    <div class="col-sm-5">
       <h4>Profile Detail</h4>
        <table class="table table-sm">
            <tr>
                <td>Sponsor ID</td>
                <th>: {{$member->sponsor_id}}</th>
            </tr>
            <tr>
                <td>Full Name</td>
                <th>: {{$member->full_name}}</th>
            </tr>
            <tr>
                <td>Username</td>
                <th>: {{$member->username}}</th>
            </tr>
            <tr>
                <td>Email</td>
                <th>: {{$member->email}}</th>
            </tr>
            <tr>
                <td>Phone</td>
                <th>: {{$member->phone}}</th>
            </tr>
            <tr>
                <td>Country</td>
                <th>: {{$member->country}}</th>
            </tr>
            <tr>
                <td colspan="2">
                    <a href="{{url('analee-admin/member/reset-password/'.$member->id)}}" class="btn btn-sm btn-primary">Reset Password</a>
                    <a href="{{url('analee-admin/member/reset-security-pin/'.$member->id)}}" class="btn btn-sm btn-warning">Reset Security Pin</a>
                    <a href="{{url('analee-admin/member/delete/'.$member->id)}}" onclick="return confirm('You want to delete?')" class="btn btn-danger btn-sm">Delete</a> 
                    <a href="{{url('analee-admin/member/credit/'.$member->id)}}" class="btn btn-success btn-sm">Add Credit</a>
                </td>
            </tr>
        </table>
       
    </div>
    <div class="col-sm-1"></div>
    <div class="col-sm-4">
        <h4>Member Wallet</h4>
        <table class="table table-sm">
            <tr>
                <td>
                    Cash Wallet
                </td>
                <td>
                    : $ {{\App\Http\Controllers\Helper::encryptor('decrypt', $member->cash_wallet)}}
                </td>
            </tr>
            <tr>
                <td>
                    Register Wallet
                </td>
                <td>
                    : $ {{\App\Http\Controllers\Helper::encryptor('decrypt', $member->register_wallet)}}
                </td>
            </tr>
            <tr>
                <td>
                    Buy Back Wallet
                </td>
                <td>
                    : $ {{ \App\Http\Controllers\Helper::encryptor('decrypt', $member->token_wallet)}}
                </td>
            </tr>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <h3>Investment</h3>
        @if($investment==null)
            <p class="text-danger">This member does not have an investment yet!</p>
        @else
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Package Name</th>
                        <th>Price</th>
                        <th>Pay Rate</th>
                        <th>Duration</th>
                        <th>Invest Date</th>
                        <th>Expired On</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$investment->name}}</td>
                        <td>{{$investment->price}} $</td>
                        <td>{{$investment->monthly_payout}}%</td>
                        <td>{{$investment->duration}} days</td>
                        <td>{{$investment->order_date}}</td>
                        <td>{{$investment->expired_on}}</td>
                    </tr>
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection