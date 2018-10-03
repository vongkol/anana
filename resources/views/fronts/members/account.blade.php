@extends('layouts.page')
@section('content')
   <div class="container" style="margin-top:150px">
    <h3>My Account
         <a href="{{url('dashboard')}}" class="btn btn-success btn-sm">Back</a>
    </h3>
    <hr>
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
    <div class="row">
            <div class="col-sm-6">
                <div>
                    <u><strong>Payment Method</strong></u>
                </div>
                <p>Please specify the payment method and detail information for your cash out.</p>
               
                <div class="form-group row">
                    <label for="" class="col-sm-3">BTC Address</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name='btc_address'>
                    </div>
                </div>
                <p>Or you can be paid by bank transfer.</p>
                <div class="form-group row">
                    <label for="" class="col-sm-3">Bank Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name='bank_name'>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-3">Account No</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name='account_no'>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-3">&nbsp;</label>
                    <div class="col-sm-9">
                        <button class="btn btn-sm btn-primary">Save</button>
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