@extends('layouts.page')
@section('content')
<div class="container">
    <div class="earning-dashboard">
        <h3>
        <span class="text-warning">EARNING </span> &nbsp;
            <a href="{{url('dashboard')}}" class="btn btn-success btn-alc"> 
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
            </a>
            <hr class="hr-alc">
        </h3>
        <br>
        <div class="row">
        <div class="col-sm-4">
            <div class="bg-light alc-box text-center height-200 font-weight-bold shadow-alc mb-5 border-radius-15">
                <h4 class="card-header">C-WALLET</h4>       
                <h5 class="p-3 margin-top-8 text-warning font-size-23">$ {{\App\Http\Controllers\Helper::encryptor('decrypt', $wallet->cash_wallet)}} </h5>
                <div class="mb-2">
                    <a href="{{url('member/transfer/register')}}" class="btn btn-warning btn-alc font-weight-bold">CONVERT TO R-WALLET </a>
                </div>
                <div class="py-2">
                    <a href="{{url('member/transfer/bwallet')}}" class="btn btn-warning btn-alc font-weight-bold"> CONVERT TO B-WALLET</a>
                </div>
                <div class="py-2">
                    <a href="{{url('member/payment')}}" class="btn btn-warning btn-alc font-weight-bold">WITHDRAW TO CASH</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4 ">
            <div class="bg-light alc-box text-center height-200 font-weight-bold shadow-alc mb-5 border-radius-15">
                <h4 class="card-header">R-WALLET</h4>
                <h5 class="p-3 margin-top-8 text-warning font-size-23">$ {{\App\Http\Controllers\Helper::encryptor('decrypt', $wallet->register_wallet)}}  </h5>
                <div class="mb-2">
                    <a href="{{url('member/transfer/anyregister')}}" class="btn btn-warning btn-alc font-weight-bold">TRANSFER TO R-WALLET</a>
                </div>
            </div>
        </div>
            <div class="col-sm-4">
            <div class="bg-light alc-box  text-center height-200 font-weight-bold shadow-alc mb-5 border-radius-15">
                <h4 class="card-header">B-WALLET</h4>
                <h5 class="p-3 font-size-23  margin-top-8  text-warning">{{\App\Http\Controllers\Helper::encryptor('decrypt', $wallet->token_wallet)}} $ = {{\App\Http\Controllers\Helper::encryptor('decrypt', $wallet->token_wallet)/$rate->rate}} ALC</h5>
                <div class="mb-2">
                    <a href="#" class="btn btn-warning btn-alc font-weight-bold disabled" >TRANSFER TO ALC-WALLET</a>
                </div>
            </div>
        </div>  

        <div class="col-sm-6">
            <div class="bg-light alc-box text-center font-weight-bold shadow-alc mb-5 border-radius-15">
            <h4 class="card-header ">SPONSOR</h4>
                <h5 class="p-3 text-warning  margin-top-8  font-size-23">$ {{$network}} </h5>
            </div>
        </div>


  <div class="col-sm-6">
            <div class="bg-light alc-box text-center alc-backgrfont-weight-bold mb-5 shadow-alc border-radius-15">
            <h4 class="card-header">BONUS</h4>
                <h5 class="p-3 text-warning  margin-top-8  font-size-23"> $ {{$bonus}}</h5>
            </div>
        </div>
    </div> 
</div>

@stop