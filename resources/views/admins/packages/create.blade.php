@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <h3 class="page-header">
            <i class="fa fa-upload"></i> Create Package 
            <a href="{{url('analee-admin/package')}}" class="btn btn-success btn-xs"><i class="fa fa-arrow-left"></i> Back</a>
        </h3>
        
    </div>
</div>
<form action="{{url('analee-admin/package/save')}}" class="form-horizontal" method="POST">
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
                <label for="name" class="col-sm-3 control-label">Package Name <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" required autofocus name="name" value="{{old('name')}}">
                </div>
            </div>
            <div class="form-group">
                <label for="price" class="col-sm-3 control-label">Price ($) <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="number" min="0" max="999999" class="form-control" required name="price" value="{{old('price')}}">
                </div>
            </div>
            <div class="form-group">
                <label for="month_payout" class="col-sm-3 control-label">Monthly Payout (%) <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" name="monthly_payout" id="monthly_payout" required value="{{old('monthly_payout')}}" min="0" max="99999">
                </div>
            </div>
            <div class="form-group">
                <label for="duration" class="col-sm-3 control-label">Duration (days) <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="number" min="0" max="9999999" class="form-control" name="duration" id="duration" required value="{{old('duration')}}">
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