@extends('layouts.page')
@section('content')
   <div class="container">
    <div class="earning-dashboard">
    <h3>
        <span class="text-warning">MY ACCOUNT</span> &nbsp;
         <a href="{{url('dashboard')}}" class="btn btn-success btn-alc"><i class="fa fa-arrow-left"></i> Back</a>
        <hr class="hr-alc">
    </h3>
    <br>
    <div class="row">
        <div class="col-sm-6">
            <div class="bg-light font-weight-bold shadow-alc p-3 mb-5 border-radius-15">
            <div>
                <h4>PROFILE INFORMATION</h4>
                <hr class="hr-alc">
            </div>
            <div class="form-group row ">
                <label for="" class="col-sm-3 col-4">Username</label>
                <div class="col-sm-9 col-8">
                    : {{$account->username}}
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-3 col-4">Full Name</label>
                <div class="col-sm-9 col-8">
                    : {{$account->full_name}}
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-3 col-4">Email</label>
                <div class="col-sm-9 col-8">
                    : {{$account->email}}
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-3 col-4">Phone</label>
                <div class="col-sm-9  col-8">
                    : {{$account->phone}}
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-3 col-4">Country</label>
                <div class="col-sm-9 col-8">
                    : {{$account->country}}
                </div>
            </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="row">
            <div class="col-sm-12">
            <div class="bg-light shadow-alc p-3 mb-4 border-radius-15">
                <h4>ACCOUNT PASSWORD</h4>
                <hr class="hr-alc">
                <div class="form-group">
                    <a href="{{url('member/change-password')}}" class="btn btn-warning btn-alc">Change Password</a>
                </div>
               
            </div>
            </div>
            <div class="col-sm-12">
            <div class="bg-light shadow-alc p-3 mb-5 border-radius-15">
                <h4>ACCOUNT SECURITY PIN</h4>
                <hr class="hr-alc">
                <div class="form-group">
                    <a href="{{url('member/change-pin')}}" class="btn btn-warning btn-alc">Change Security PIN</a>
                </div>
            </div>
        </div>
        </div>
        </div>
    </div>
<?php $ivs = DB::table('investments')->where('member_id', $account->id)->first(); ?>

    @if($ivs!=null)
    <div class="row">
        <div class="col-sm-12">
            <div class="bg-light font-weight-bold shadow-alc p-3 mb-5 border-radius-15">
            <h4>REFERRAL LINK</h4>
            <hr class="hr-alc">
            <div class="form-group row">
                <label for="" class="col-sm-3">Referral Link <span class="float-right">:</span></label>
                <div class="col-sm-9">
                    <input type="text" readonly value="{{url('/sign-up?sponsor='.$account->username)}}" class="form-control border-radius-22" id="link">
                    <br>
                    <button class="btn btn-secondary btn-alc" style="margin-top:9px" onclick="doCopy()">Copy Link</button>
                </div>
            </div>
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-sm-12">
        <div class="bg-light font-weight-bold shadow-alc p-3 mb-5 border-radius-15">
           <form action="#" method="POST">
                {{csrf_field()}}
                <h4>REFERRAL LINK</h4>
                <hr class="hr-alc">
                <div class="form-group row">
                    <label for="" class="col-sm-3">ALC Address <span class="float-right">:</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control border-radius-22" name="anc_address" {{$account->anc_address!=null?'disabled':''}} value="{{$account->anc_address}}">
                        @if($account->anc_address==null)
                        <p>
                            <button class="btn btn-primary btn-alc">Save</button>
                        </p>
                        @endif
                    </div>
                </div>
           </form>
        </div>
        </div>
    </div>
    <div class="row">
            <div class="col-sm-12">
            <div class="bg-light font-weight-bold shadow-alc p-3 mb-5 border-radius-15">
                <h4>PAYMENT INFORMATION</h4>
                <hr class="hr-alc">
                
                <h6 class="text-primary">
                    <br>
                    Please accurately complete your payment information in the form below:
                </h6>
                <p>&nbsp;</p>
                <!-- <div class="form-group row">
                    <label for="" class="col-sm-3">BTC Address</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name='btc_address'>
                    </div>
                </div> -->
                @if($bank!=null)
                <form action="{{url('member/address/update')}}" method="POST">
                    {{csrf_field()}}
                    <div class="form-group row">
                        <label for="" class="col-sm-3">Bank Name <span class="float-right">:</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control border-radius-22" name='bank_name' value="{{$bank->bank_name}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3">Bank Branch Name <span class="float-right">:</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control border-radius-22" name='branch_name' value="{{$bank->branch_name}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3">Swift Code <span class="float-right">:</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control border-radius-22" name='swift_code' value="{{$bank->swift_code}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3">Bank Address <span class="float-right">:</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control border-radius-22" name='address' value="{{$bank->address}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3">Full Name <span class="float-right">:</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control border-radius-22" name='full_name' value="{{$bank->full_name}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3">Account Number <span class="float-right">:</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control border-radius-22" name='account_no' value="{{$bank->account_no}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3">&nbsp;</label>
                        <div class="col-sm-9">
                            <button class="btn btn-primary btn-alc">Save</button>
                        </div>
                    </div>
                </form>
                @else

                    <form action="{{url('member/address/save')}}" method="POST">
                        {{csrf_field()}}
                        <div class="form-group row">
                            <label for="" class="col-sm-3">Bank Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control border-radius-22" name='bank_name' value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3">Bank Branch Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control border-radius-22" name='branch_name' value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3">Swift Code</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control border-radius-22" name='swift_code' value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3">Bank Address</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control border-radius-22" name='address' value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3">Full Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control border-radius-22" name='full_name' value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3">Account Number</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control border-radius-22" name='account_no' value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-9">
                                <button class="btn btn-primary btn-alc">Save</button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
        </div>
   </div>
   </div>
   <script>
       function doCopy()
       {
            document.getElementById('link').select();
            document.execCommand("copy");
            alert('Referral link is copied to the clipboard!');
       }
   </script>
@endsection