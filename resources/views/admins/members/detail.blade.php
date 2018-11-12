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
                    <p><strong class="text-danger">ALC Address:</strong></p>
                    <p>{{$member->anc_address}}</p>
                </td>
            </tr>
             <tr>
                <td>Sale Volume</td>
                <td>
                    : $ {{$member->sale_volume}}
                </td>
            </tr>
            <tr>
                <td>Sale Bonus</td>
                <td>
                    : $ {{$member->sale_bonus}}
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    @update('Member')
                    <a href="{{url('analee-admin/member/reset-password/'.$member->id)}}" class="btn btn-sm btn-primary">Reset Password</a>
                    
                    <a href="{{url('analee-admin/member/reset-security-pin/'.$member->id)}}" class="btn btn-sm btn-warning">Reset Security Pin</a>
                     
                    <a href="{{url('analee-admin/member/volume/'. $member->id)}}" class="btn btn-primary btn-sm">Edit Sale Volume</a>
                    @endupdate
                    @delete('Member')
                    <a href="{{url('analee-admin/member/delete/'.$member->id)}}" onclick="return confirm('You want to delete?')" class="btn btn-danger btn-sm">Delete</a>
                    @enddelete
                    @view('Add Credit')
                    <a href="{{url('analee-admin/member/credit/'.$member->id)}}" class="btn btn-success btn-sm">Add Credit</a>
                    @endview
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
            <h4 class="text-danger">Bank Account</h4>
            @if($bank!=null)
            <table class="table table-sm">
                <tr>
                    <td>
                        Bank Name
                    </td>
                    <td>
                        : {{$bank->bank_name}}
                    </td>
                </tr>
                <tr>
                    <td>
                        Bank Branch Name
                    </td>
                    <td>
                        : {{$bank->branch_name}}
                    </td>
                </tr>
                <tr>
                    <td>
                        Swift Code
                    </td>
                    <td>
                        : {{$bank->swift_code}}
                    </td>
                </tr>
                <tr>
                    <td>
                        Bank Address
                    </td>
                    <td>
                        : {{$bank->address}}
                    </td>
                </tr>
                <tr>
                    <td>
                        Full Name
                    </td>
                    <td>
                        : {{$bank->full_name}}
                    </td>
                </tr>
                <tr>
                    <td>
                        Account Number
                    </td>
                    <td>
                        : {{$bank->account_no}}
                    </td>
                </tr>
            </table>
            @else
                <p>No bank information!</p>
            @endif
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
<div class="row">
    <div class="col-sm-12">
        <h3>Direct Downline</h3>
        @if($networks==null)
            <p class="text-danger">This member does not have any download!</p>
        @else
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Investment Name</th>
                        <th>Investment Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($networks as $n)
                        <tr>
                            <td>{{$n->full_name}}</td>
                            <td>{{$n->username}}</td>
                            <td>{{$n->email}}</td>
                            <td>{{$n->name}}</td>
                            <td>$ {{$n->price}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection