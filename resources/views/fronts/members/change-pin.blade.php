@extends('layouts.page')
@section('content')
   <div class="container">
    <div class="earning-dashboard">
    <h3>
    <span class="text-warning">MY ACCOUNT</span> / <span class="text-warning">ACCOUNT SECURITY PIN</span> &nbsp;
         <a href="{{url('member/account/'.$id)}}" class="btn btn-success btn-alc"><i class="fa fa-arrow-left"></i> Back</a>
         <hr class="hr-alc">
    </h3>
   <br>
    <div class="row">
        <div class="col-sm-12">
            <div class="bg-light font-weight-bold shadow-alc p-3 border-radius-15">
                <h4>CHANGE SECURITY PIN</h4>
                <hr class="hr-alc">
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
                <h5 class="col-md-4">Old Security PIN <span class="text-danger">*</span></h5>
                    <div class="col-sm-8">
                        <input type="password" name="old_pin" required class="form-control border-radius-22" value="">
                    </div>
                </div>
                <div class="form-group row">
                <h5 class="col-md-4">New Security PIN <span class="text-danger">*</span></h5>
                    <div class="col-sm-8">
                        <input type="password" name="security_pin" required class="form-control border-radius-22" value="{{old('security_pin')}}">
                    </div>
                </div>
                 <div class="form-group row">
                    <h5 class="col-md-4">Confirm New Security PIN <span class="text-danger">*</span></h5>
                    <div class="col-sm-8">
                        <input type="password" name="cpin" required class="form-control border-radius-22" value="{{old('cpin')}}">
                    </div>
                </div>
                 <div class="form-group row">
                 <label for="" class="col-sm-4">&nbsp;</label>
                    <div class="col-sm-8">
                        <button class="btn btn-primary btn-alc">Change</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
   </div>
@endsection