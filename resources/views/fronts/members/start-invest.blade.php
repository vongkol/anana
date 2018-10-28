@extends('layouts.page')
@section('content')
<div class="container" style="margin-top:150px">
        <h3>Start An Investment <a href="{{url('dashboard')}}" class="btn btn-success btn-sm">  <i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a></h3>
        <hr>
        <form action="{{url('member/investment/save')}}" method="POST">
            {{csrf_field()}}
            <div class="row">
                <div class="col-sm-7">
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
                    <div class="form-group row">
                        <label for="" class="col-sm-4">My Register Wallet</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="r_wallet" value="{{$member->register_wallet}}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-4">Choose Your Package</label>
                        <div class="col-sm-8">
                            <select name="package" id="package" class="form-control">
                                <option value="0">-- choose a package --</option>
                                @foreach($packages as $p)
                                    <option value="{{$p->id}}">{{$p->name}} - {{$p->price}} USD</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="control-label col-sm-4">Security PIN <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" name="pin" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="control-label col-sm-4">&nbsp;</label>
                        <div class="col-sm-8">
                            <button class="btn btn-primary btn-sm" type="submit">Invest Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
</div>
@stop