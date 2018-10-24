@extends('layouts.page')
@section('content')
   <div class="container" style="margin-top:150px">
    <h3>
        <img src="{{asset('images/myaccount.png')}}" alt="" width="50">
        My Account
         <a href="{{url('dashboard')}}" class="btn btn-success btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
    </h3>
    <p></p>
    <div class="row">
        <div class="col-sm-6">
            <div>
                <u><strong>Profile Information</strong></u>
            </div>
            <p></p>
            <div class="form-group row">
                <label for="" class="col-sm-3">Username</label>
                <div class="col-sm-9">
                    : {{$account->username}}
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-3">Full Name</label>
                <div class="col-sm-9">
                    : {{$account->full_name}}
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-3">Email</label>
                <div class="col-sm-9">
                    : {{$account->email}}
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-3">Phone</label>
                <div class="col-sm-9">
                    : {{$account->phone}}
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-3">Country</label>
                <div class="col-sm-9">
                    : {{$account->country}}
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div>
                <u><strong>Account Security</strong></u>
            </div>
            <p></p>
            <div class="form-group row">
                <a href="#" class="btn btn-primary">Change Password</a>
            </div>
            <div class="form-group row">
                <a href="#" class="btn btn-warning">Change Security PIN</a>
            </div>
        </div>
    </div>
<?php $ivs = DB::table('investments')->where('member_id', $account->id)->first(); ?>

    @if($ivs!=null)
    <div class="row">
        <div class="col-sm-9">
            <div>
                <u><strong>Referral Link</strong></u>
            </div>
            <p></p>
            <div class="form-group row">
                <label for="" class="col-sm-3">Referral Link</label>
                <div class="col-sm-9">
                    <input type="text" readonly value="{{url('/sign-up?sponsor='.$account->username)}}" class="form-control" id="link">
                    <button class="btn btn-sm btn-secondary" style="margin-top:9px" onclick="doCopy()">Copy Link</button>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-sm-9">
           <form action="#" method="POST">
                {{csrf_field()}}
                <div>
                    <u><strong>ANC Address</strong></u>
                </div>
                <p></p>
                <div class="form-group row">
                    <label for="" class="col-sm-3">ANC Address</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="anc_address" {{$account->anc_address!=null?'disabled':''}} value="{{$account->anc_address}}">
                        @if($account->anc_address==null)
                        <p>
                            <button class="btn btn-primary">Save</button>
                        </p>
                        @endif
                    </div>
                </div>
           </form>
        </div>
    </div>
    <div class="row">
            <div class="col-sm-8">
                <div>
                    <u><strong>Payment Method</strong></u>
                </div>
                <p>Please specify the payment method and detail information for your cash out.</p>
               
                <!-- <div class="form-group row">
                    <label for="" class="col-sm-3">BTC Address</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name='btc_address'>
                    </div>
                </div> -->
                <p>Or you can be paid by bank transfer.</p>
                <form action="{{url('member/address/save')}}" method="POST">
                    {{csrf_field()}}
                    <div class="form-group row">
                    <label for="" class="col-sm-3">Bank Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name='bank_name' value="{{$bank->bank_name}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-3">Bank Branch Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name='branch_name' value="{{$bank->branch_name}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-3">Swift Code</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name='swift_code' value="{{$bank->swift_code}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-3">Bank Address</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name='address' value="{{$bank->address}}">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="" class="col-sm-3">Full Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name='full_name' value="{{$bank->full_name}}">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="" class="col-sm-3">Account No</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name='account_no' value="{{$bank->account_no}}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-3">&nbsp;</label>
                    <div class="col-sm-9">
                        <button class="btn btn-sm btn-primary">Save</button>
                    </div>
                </div>
                </form>
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