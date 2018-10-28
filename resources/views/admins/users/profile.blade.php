@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <h3 class="page-header">
            <i class="fa fa-key"></i> User Profile
            <a href="{{url('analee-admin/user')}}" class="btn btn-success btn-xs"><i class="fa fa-arrow-left"></i> Back</a>
        </h3>
        
    </div>
</div>
<form action="#" class="form-horizontal" method="POST">
    {{csrf_field()}}
    <div class="row">
        <div class="col-sm-7">
            <div class="form-group">
                <label for="name" class="col-sm-2">Full Name</label>
                <div class="col-sm-10">
                    : {{$user->name}}
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email <span class="text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" required  name="email" value="{{$user->email}}">
                </div>
            </div>
            <div class="form-group">
                <label for="role" class="col-sm-2 control-label">Role <span class="text-danger">*</span></label>
                <div class="col-sm-10">
                    {{$user->rname}}
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" name="password" value="">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">&nbsp;</label>
                <div class="col-sm-10">
                    <button class="btn btn-primary" type="submit">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection