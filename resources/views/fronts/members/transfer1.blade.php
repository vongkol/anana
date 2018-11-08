@extends('layouts.page')
@section('content')
<div class="container">
    <div class="earning-dashboard">
        <h3>
            
        <span class="text-warning"> TRANSFTER TO YOUR OWN REGISTER WALLET</span>&nbsp;
        <a href="{{url('member/earning')}}" class="btn btn-success btn-alc">
         <i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a>
        <hr class="hr-alc">
        </h3>
        <br>
        <div class="row">
            <div class="col-sm-12">
            <div class="bg-light font-weight-bold shadow-alc p-3 border-radius-15">
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
                <form action="{{url('member/transfer/register/save')}}" method="POST">
                    {{csrf_field()}}<br>
                    <div class="form-group row">
                        <h5 class="col-md-3">Cash Wallet</h5> 
                        <div class="col-sm-8">
                            <input type="text" class="form-control border-radius-22" readonly 
                                value="{{\App\Http\Controllers\Helper::encryptor('decrypt', $member->cash_wallet)}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <h5 class="col-md-3">Amount to transfer <span class="text-danger">*</span></h5> 
                        <div class="col-sm-8">
                            <input type="number" class="form-control border-radius-22" placeholder="$" name="amount" min="0.000" step="0.001" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="control-label col-sm-3">&nbsp;</label>
                        <div class="col-sm-8">
                            <button class="btn btn-primary btn-alc">Transfer</button>
                        </div>
                    </div>
                </form>
            </div>
</div>
        </div>
    </div>
</div>
@stop