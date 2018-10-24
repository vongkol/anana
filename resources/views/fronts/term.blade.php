@extends('layouts.page')
@section('content')
<div class="container">
    <div class="earning-dashboard">
        <h3>
            <img src="{{asset('images/termandcondiction.png')}}" width="50" alt="">   
            Terms and Conditions <a href="{{url('dashboard')}}" class="btn btn-success btn-sm"> <i class="fa fa-arrow-left"></i> Back</a></h3>
        <p></p>
        <div class="row">
            <div class="col-sm-12">
                <p>
                    terms and conditions ...
                </p>
            </div>
        </div> 
    </div>
</div>
@stop