@extends('layouts.page')
@section('content')
<div class="container" style="margin-top:150px">
    <h3>Cash Withdraw Request <a href="{{url('member/earning')}}" class="btn btn-success btn-sm">  <i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a></h3>
    <p></p>
    <div class="row">
        <div class="col-sm-9">
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
            <form action="{{url('member/payment/save')}}" method="POST">
                {{csrf_field()}}
                <div class="form-group row">
                    <label for="" class="control-label col-sm-3">Available Balance</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" readonly value="{{$member->cash_wallet}} $">
                    </div>
                </div>
               
                <div class="form-group row">
                    <label for="" class="control-label col-sm-3">Request Amount <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" name="amount" min="0.000" step="0.001" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="control-label col-sm-3">Security PIN <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" name="pin" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="control-label col-sm-3">&nbsp;</label>
                    <div class="col-sm-8">
                        <button class="btn btn-primary">Request</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop