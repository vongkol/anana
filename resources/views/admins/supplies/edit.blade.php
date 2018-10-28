@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <h3 class="page-header">
            <i class="fa  fa-ambulance"></i> Edit Role 
            <a href="{{url('anana-admin/supply')}}" class="btn btn-success btn-xs"><i class="fa fa-arrow-left"></i> Back</a>
        </h3>
        
    </div>
</div>
<form action="{{url('anana-admin/supply/update')}}" accept-charset="UTF-8" class="form-horizontal" method="POST">
    {{csrf_field()}}
    <input type="hidden" name="id" value="{{$supply->id}}">
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
                <label for="title" class="col-sm-3 control-label">Title <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" required autofocus name="title" value="{{$supply->title}}">
                </div>
            </div>
            <div class="form-group">
                <label for="total_token" class="col-sm-3 control-label">Total E-share <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" required autofocus name="total_token" value="{{$supply->total_token}}">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">&nbsp;</label>
                <div class="col-sm-9">
                    <button class="btn btn-primary" type="submit">Save Change</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection