@extends('layouts.page')
@section('content')
<div class="container">
    <div class="earning-dashboard">
        <h3>
        <span class="text-warning">MY EARNING </span> &nbsp;
            <a href="{{url('dashboard')}}" class="btn btn-success btn-alc"> 
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
            </a>
            <hr class="hr-alc">
        </h3>
        <br>
        <div class="row">
        <div class="col-sm-4">
            <div class="bg-light  height-200 font-weight-bold shadow-alc p-3 mb-5 border-radius-15">
                <h4><span class="text-warning">$</span> C-WALLET</h4>
                <hr class="hr-alc">
                <h5><span class="text-warning">$</span> {{\App\Http\Controllers\Helper::encryptor('decrypt', $wallet->cash_wallet)}} </h5>
              
                    <div class="py-2">
                    <a href="{{url('member/transfer/register')}}" class="btn btn-warning btn-alc"> To R-Wallet</a>
                    </div>
                    <div class="py-2">
                        <a href="{{url('member/transfer/bwallet')}}" class="btn btn-warning btn-alc"> To B-Wallet</a>
                    </div>
                    <div class="py-2">
                        <a href="{{url('member/payment')}}" class="btn btn-warning btn-alc"> Withdraw To Cash </a>
                    </div>
       
            </div>
        </div>
        <div class="col-sm-4 ">
            <div class="bg-light  height-200 font-weight-bold shadow-alc p-3 mb-5 border-radius-15">
                <h4><span class="text-warning">$</span>  R-WALLET</h4>
                <hr class="hr-alc">
                <h5><span class="text-warning">$</span> {{\App\Http\Controllers\Helper::encryptor('decrypt', $wallet->register_wallet)}}  </h5>
                <div class="py-2">
                    <a href="{{url('member/transfer/anyregister')}}" class="btn btn-warning btn-alc">R-Wallet To R-Wallet</a>
                    </div>
            </div>
        </div>
            <div class="col-sm-4">
            <div class="bg-light height-200 font-weight-bold shadow-alc p-3 mb-5 border-radius-15">
                <h4><span class="text-warning">$</span>  B-WALLET</h4>
                <hr class="hr-alc">
                <h5>{{\App\Http\Controllers\Helper::encryptor('decrypt', $wallet->token_wallet)}} $ = {{\App\Http\Controllers\Helper::encryptor('decrypt', $wallet->token_wallet)/$rate->rate}} ALC</h5>
            </div>
        </div>  

        <div class="col-sm-6">
            <div class="bg-light font-weight-bold shadow-alc p-3 mb-5 border-radius-15">
            <h4><span class="text-warning">$</span> SPONSOR</h4>
            <hr class="hr-alc">
                <h5><span class="text-warning">$</span> {{$network}} </h5>
            </div>
        </div>


  <div class="col-sm-6">
            <div class="bg-light font-weight-bold shadow-alc p-3 border-radius-15">
            <h4><span class="text-warning">$</span> BONUS</h4>
            <hr class="hr-alc">
                <h5><span class="text-warning">$</span> {{$bonus}}</h5>
            </div>
        </div>
    </div> 
</div>

@stop