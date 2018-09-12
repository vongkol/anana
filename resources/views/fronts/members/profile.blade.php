@extends('layouts.member')
@section('content')
    <p></p>
    <h4>My Profile</h4>
    <hr>
    <div class="row">
        <div class="col-sm-8">
            <div class="form-group row">
                <label for="" class="col-sm-3">First Name</label>
                <div class="col-sm-9">
                    : <strong>{{$profile->first_name}}</strong>
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-3">Last Name</label>
                <div class="col-sm-9">
                    : <strong>{{$profile->last_name}}</strong>
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-3">Gender</label>
                <div class="col-sm-9">
                    : <strong>{{$profile->gender}}</strong>
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-3">Country</label>
                <div class="col-sm-9">
                    : <strong>{{$profile->country}}</strong>
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-3">City</label>
                <div class="col-sm-9">
                    : <strong>{{$profile->city}}</strong>
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-3">Email</label>
                <div class="col-sm-9">
                    : <strong>{{$profile->email}}</strong>
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-3">Phone</label>
                <div class="col-sm-9">
                    : <strong>{{$profile->phone}}</strong>
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-3">Referal Link</label>
                <div class="col-sm-9">
                    : <a href="#" class="text-primary">{{url('/sign-up?ref='.md5($profile->id))}}</a>
                </div>
            </div>
        </div>
    </div>
@endsection