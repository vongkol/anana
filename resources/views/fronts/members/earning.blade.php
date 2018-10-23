@extends('layouts.page')
@section('content')
<div class="container" style="margin-top:150px">
    <h3>My Earning <a href="{{url('dashboard')}}" class="btn btn-success btn-sm">Back</a></h3>
    <p></p>
    <div class="row">
        <div class="col-sm-4">
            <h4>C-Wallet</h4>
            <hr>
            <strong class="text-primary">{{$wallet->cash_wallet}} $</strong>
            <p></p>
            <div>
                <a href="{{url('member/transfer/register')}}" class="text-primary">To R-Wallet</a>
                <br>
                <a href="{{url('member/transfer/bwallet')}}" class="text-primary">To B-Wallet</a>
                <br>
                <a href="{{url('member/payment')}}" class="text-primary">Withdraw To Cash </a>
            </div>
        </div>
        <div class="col-sm-4">
            <h4>R-Wallet</h4>
            <hr>
            <strong class="text-warning">{{$wallet->register_wallet}} $</strong>
            <p></p>
            <div>
                <a href="{{url('member/transfer/anyregister')}}" class="text-primary">R-Wallet To R-Wallet</a>
            </div>
        </div>
        <div class="col-sm-4">
            <h4>B-Wallet</h4>
            <hr>
            <strong class="text-danger">{{$wallet->token_wallet}} $ = {{$wallet->token_wallet/$rate->rate}} ANC</strong>
            <p></p>
            <div>
                <a href="{{url('member/transfer/anc')}}" class="text-primary">Withdraw To ANC</a>
            </div>
        </div>
    </div>  
    <hr>
    <div class="row">
        <!-- <div class="col-sm-4">
            <h4>Reward This Month</h4>
            <hr>
            <strong class="text-warning">{{$reward}} $</strong>
        </div> -->
        <div class="col-sm-6">
            <h4>Sponsor</h4>
            <hr>
            <strong class="text-warning">{{$network}} $</strong>
        </div>
        <div class="col-sm-6">
            <h4>Bonus</h4>
            <hr>
            <strong class="text-warning">0 $</strong>
        </div>
    </div> 
</div>

@stop