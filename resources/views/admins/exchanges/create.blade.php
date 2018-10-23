@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <h3 class="page-header">
            <i class="fa fa-dollar"></i> Create Exchange 
            <a href="{{url('anana-admin/exchange')}}" class="btn btn-success btn-xs"><i class="fa fa-arrow-left"></i> Back</a>
        </h3>
        
    </div>
</div>
<form action="{{url('anana-admin/exchange/save')}}" class="form-horizontal" method="POST">
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
            <div class="form-group">
                <label for="currency" class="col-sm-3 control-label">Currency <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" required autofocus name="currency" value="{{old('currency')}}">
                </div>
            </div>
            <div class="form-group">
                <label for="rate" class="col-sm-3 control-label">Rate<span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="number" min="0" step="0.1" max="999999" class="form-control" required name="rate" value="{{old('rate')}}">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">&nbsp;</label>
                <div class="col-sm-9">
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection