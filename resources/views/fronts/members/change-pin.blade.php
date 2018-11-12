@extends('layouts.page')
@section('content')
   <div class="container">
    <div class="earning-dashboard">
    <h3>
    <span class="text-warning">ACCOUNT SECURITY PIN</span> &nbsp;
         <a href="{{url('member/account/'.$id)}}" class="btn btn-success btn-alc"><i class="fa fa-arrow-left"></i> Back</a>
         <hr class="hr-alc">
    </h3>
   <br>
    <div class="row">
        <div class="col-sm-12">
            <div class="bg-light alc-box font-weight-bold shadow-alc mb-5 border-radius-15">
                <h4 class="card-header">CHANGE SECURITY PIN</h4>
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
            <div class="p-3 font-size-16 text-blue">
                <form action="{{url('member/change-pin/save')}}" method="POST">
                    {{csrf_field()}}
                    <div class="form-group row">
                        <label class="col-md-3">OLD SECURITY PIN<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="password" name="old_pin" required class="form-control border-radius-22" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">NEW SECURITY PIN<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="password" name="security_pin" required class="form-control border-radius-22" value="{{old('security_pin')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">CONFIRM NEW SECRITY PIN<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="password" name="cpin" required class="form-control border-radius-22" placeholder="****" value="{{old('cpin')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                       
                            <label for="" class="col-sm-9 mb-none">&nbsp;</label>
                      
                        <div class="col-sm-3">
                            <button class="btn btn-warning btn-alc">CHANGE</button>
                        </div>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
   </div>
@endsection