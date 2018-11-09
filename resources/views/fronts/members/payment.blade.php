@extends('layouts.page')
@section('content')
<div class="container">
<div class="earning-dashboard">
    <h3 class="text-warning">
        WITHDRAW TO CASH  &nbsp;<a href="{{url('member/earning')}}" class="btn btn-success btn-alc"> 
    <i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a>
    <hr class="hr-alc">
    </h3>
    <br>
    <div class="row">
        <div class="col-sm-12">
            <div class="bg-light font-weight-bold alc-box font-size-16 mb-5  text-blue shadow-alc p-3 border-radius-15">
            @if(Session::has('sms'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div>
                        {{session('sms')}}
                    </div>
                </div>
            @endif
            @if(Session::has('sms1'))
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div>
                        {{session('sms1')}}
                    </div>
                </div>
            @endif
            <div class="p-3">
            <form action="{{url('member/payment/save')}}" method="POST">
                {{csrf_field()}}
                <div class="form-group row">
                    <label for="" class="control-label col-sm-3">AVAILABLE BALANCE &nbsp; ( USD )</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control border-radius-22" readonly value="{{\App\Http\Controllers\Helper::encryptor('decrypt', $member->cash_wallet)}}">
                    </div>
                </div>
               
                <div class="form-group row">
                    <label for="" class="control-label col-sm-3">REQUEST AMOUNT<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control border-radius-22" name="amount" placeholder="USD" min="0.000" step="0.001" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="control-label col-sm-3">SECURITY PIN<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control border-radius-22" placeholder="****" name="pin" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="control-label col-sm-9 mb-none">&nbsp;</label>
                    <div class="col-sm-3">
                        <button class="btn btn-warning btn-alc">REQUEST</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
    </div>
</div>
@stop