@extends('layouts.page')
@section('content')
<div class="container">
<div class="earning-dashboard">
        <h3 class="text-warning">START AM INVESTMENT
            <a href="{{url('dashboard')}}" class="btn btn-alc btn-success"> 
            <i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a>
            <hr class="hr-alc">
        </h3><br>
     <div class="row">  
     <div class="col-sm-12">
            <div class="bg-light alc-box font-weight-bold shadow-alc mb-5 border-radius-15">
            <div class="p-3 font-size-16">
        <form action="{{url('member/investment/save')}}" method="POST">
            {{csrf_field()}}
            <div class="row">
                <div class="col-sm-12">
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
                    @endif<br>
                    <div class="form-group row">
                        <label for="" class="col-sm-3">R-WALLET</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control border-radius-22" name="r_wallet" 
                                value="{{\App\Http\Controllers\Helper::encryptor('decrypt', $member->register_wallet)}}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3">CHOOSE PACKAGE</label>
                        <div class="col-sm-9">
                            <select name="package" id="package" class="form-control border-radius-22">
                                <option value="0">-- choose a package --</option>
                                @foreach($packages as $p)
                                    <option value="{{$p->id}}">{{$p->name}} - {{$p->price}} USD</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="control-label col-sm-3">SECURITY PIN<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control border-radius-22" name="pin" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="control-label mb-none col-sm-9">&nbsp;</label>
                        <div class="col-sm-3">
                            <button class="btn btn-warning btn-alc" type="submit" 
                             onclick="return confirm('Do you want to invest?')">Invest Now</button>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </form>
    </div>
    </div></div>
</div>
@stop