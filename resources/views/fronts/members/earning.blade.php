@extends('layouts.page')
@section('content')
<div class="container">
    <div class="earning-dashboard">
        <h3>
            <img src="{{asset('images/earning.png')}}" alt="" width="50"> My Earning 
            <a href="{{url('dashboard')}}" class="btn btn-success btn-sm">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
            </a>
        </h3>
        <p></p>
        <div class="row">
            <div class="col-sm-4">
                <hr>
                <h4 class="text-info"><i class="fa fa-money"></i> C-Wallet</h4>
                <hr>
                <strong class="text-info">{{$wallet->cash_wallet}} $</strong>
                <p></p>
                <div>
                    <a href="{{url('member/transfer/register')}}" class="text-primary"><i class="fa fa-arrow-right"></i> To R-Wallet</a>
                    <br>
                    <a href="{{url('member/transfer/bwallet')}}" class="text-primary"><i class="fa fa-arrow-right"></i>  To B-Wallet</a>
                    <br>
                    <a href="{{url('member/payment')}}" class="text-primary"><i class="fa fa-arrow-right"></i>  Withdraw To Cash </a>
                </div>
            </div>
            <div class="col-sm-4">
                <hr>
                <h4 class="text-warning"><i class="fa fa-money"></i> R-Wallet</h4>
                <hr>
                <strong class="text-warning">{{$wallet->register_wallet}} $</strong>
                <p></p>
                <div>
                    <a href="{{url('member/transfer/anyregister')}}" class="text-primary"><i class="fa fa-arrow-right"></i>  R-Wallet To R-Wallet</a>
                </div>
            </div>
            <div class="col-sm-4">
                <hr>
                <h4 class="text-danger"><i class="fa fa-money"></i> B-Wallet</h4>
                <hr>
                <strong class="text-danger">{{$wallet->token_wallet}} $ = {{$wallet->token_wallet/$rate->rate}} ANC</strong>
                <p></p>
                <div>
                    <a href="{{url('member/transfer/anc')}}" class="text-primary"> <i class="fa fa-arrow-right"></i> Withdraw To ANC</a>
                </div>
            </div>
        </div>  
       
        <div class="row">
            <!-- <div class="col-sm-4">
                <h4>Reward This Month</h4>
                <hr>
                <strong class="text-warning">{{$reward}} $</strong>
            </div> -->
            <div class="col-sm-6">
                <hr>
                <h4><i class="fa fa-money"></i> Sponsor</h4>
                <hr>
                <strong>{{$network}} $</strong>
            </div>
            <div class="col-sm-6">
                <hr>
                <h4 class="text-success"><i class="fa fa-money"></i> Bonus</h4>
                <hr>
                <strong class="text-success">{{$bonus}} $</strong>
            </div>
        </div>
    </div> 
</div>

@stop