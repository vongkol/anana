@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <h3 class="page-header">
            <i class="fa fa-key"></i> Create User 
            <a href="{{url('analee-admin/user')}}" class="btn btn-success btn-xs"><i class="fa fa-arrow-left"></i> Back</a>
        </h3>
        
    </div>
</div>
<form action="{{url('analee-admin/user/save')}}" class="form-horizontal" method="POST">
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
                <label for="name" class="col-sm-2 control-label">Full Name <span class="text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" required autofocus name="name" value="{{old('name')}}">
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email <span class="text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" required  name="email" value="{{old('email')}}">
                </div>
            </div>
            <div class="form-group">
                <label for="role" class="col-sm-2 control-label">Role <span class="text-danger">*</span></label>
                <div class="col-sm-10">
                    <select name="role" id="role" class="form-control">
                        @foreach($roles as $r)
                            <option value="{{$r->id}}">{{$r->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-sm-2 control-label">Password <span class="text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" required name="password">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">&nbsp;</label>
                <div class="col-sm-10">
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection