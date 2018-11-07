@extends('layouts.page')
@section('content')
   <div class="container">
    <div class="earning-dashboard">
    <h3>
        <img src="{{asset('images/myaccount.png')}}" alt="" width="50">
        My Account
         <a href="{{url('member/account/'.$id)}}" class="btn btn-success btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
    </h3>
    <p></p>
    <div class="row">
        <div class="col-sm-7">
            <div>
                <u><strong>Change Security PIN</strong></u>
            </div>
            <p></p>
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
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{url('member/change-pin/save')}}" method="POST">
                {{csrf_field()}}
                <div class="form-group row">
                    <label for="" class="col-sm-3">Old Security PIN <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="password" name="old_pin" required class="form-control" value="">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-3">New Security PIN <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="password" name="security_pin" required class="form-control" value="{{old('security_pin')}}">
                    </div>
                </div>
                 <div class="form-group row">
                    <label for="" class="col-sm-3">Confirm New Security PIN <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="password" name="cpin" required class="form-control" value="{{old('cpin')}}">
                    </div>
                </div>
                 <div class="form-group row">
                    <label for="" class="col-sm-3">&nbsp;</label>
                    <div class="col-sm-9">
                        <button class="btn btn-primary">Change</button>
                        <p>&nbsp;</p>
                    </div>
                </div>
            </form>
            
        </div>
        
    </div>

   
   </div>
  
@endsection