@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <h3 class="page-header">
            <i class="fa fa-lock"></i> Add Credit To [{{$member->username}}] 
            <a href="{{url('anana-admin/member/detail/'.$member->id)}}" class="btn btn-success btn-xs"><i class="fa fa-arrow-left"></i> Back</a>
        </h3>
        
    </div>
</div>
<form action="{{url('anana-admin/member/credit/save')}}" class="form-horizontal" method="POST" onsubmit="return confirm('You want to transfer?')">
    {{csrf_field()}}
    <input type="hidden" value="{{$member->id}}" name="id">
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
            <div class="form-group">
                <label for="" class="col-sm-3 control-label">Amount To Transfer <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" required autofocus name="credit" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">&nbsp;</label>
                <div class="col-sm-9">
                    <button class="btn btn-primary" type="submit">Transfer</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection