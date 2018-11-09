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
			<div class="bg-light alc-box font-weight-bold shadow-alc mb-5 border-radius-15">
            <h4 class="card-header">PROFILE INFORMATION</h4>
                <div class="p-3 text-blue font-size-16">
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-4">USERNAME</label>
                        <div class="col-sm-9 col-8 p-2">
                            :  &nbsp; {{$account->username}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-4">FULL NAME</label>
                        <div class="col-sm-9 col-8 p-2">
                            :  &nbsp; {{$account->full_name}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-4">EMAIL</label>
                        <div class="col-sm-9 col-8 p-2">
                            :  &nbsp; {{$account->email}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-4">PHONE</label>
                        <div class="col-sm-9  col-8 p-2">
                            : &nbsp; {{$account->phone}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-4">COUNTRY</label>
                        <div class="col-sm-9 col-8 p-2">
                            :  &nbsp; {{$account->country}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="row">
                <div class="col-sm-12">
                    <div class="bg-light alc-box font-weight-bold shadow-alc mb-5 border-radius-15">
                        <h4 class="card-header">ACCOUNT PASSWORD</h4>
                        <div class="p-3 mt-2">
                        <div class="form-group">
                            <a href="{{url('member/change-password')}}" class="btn btn-warning btn-alc font-weight-bold">CHANGE PASSWORD</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="bg-light alc-box font-weight-bold shadow-alc mb-5 border-radius-15">
                            <h4 class="card-header">ACCOUNT SECURITY PIN</h4>
                            <div class="p-3 mt-2">
                                <div class="form-group">
                                    <a href="{{url('member/change-pin')}}" class="btn btn-warning btn-alc font-weight-bold">CHANGE SECURITY PIN</a>
                                </div>
                            </div>
                        </div>
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
            <div class="bg-light alc-box font-weight-bold shadow-alc mb-5 border-radius-15">
                <h4 class="card-header">REFERRAL LINK</h4>
                <div class="p-3 font-size-16">
                    <div class="form-group row">
                        <label class="col-sm-3 text-blue">REFERRAL LINK<span class="float-right">:</span></label>
                        <div class="col-sm-9">
                            <input type="text" readonly value="{{url('/sign-up?sponsor='.$account->username)}}" class="form-control border-radius-22" id="link">
                            <button class="btn btn-warning btn-alc font-weight-bold" style="margin-top:9px" onclick="doCopy()">COPY LINK</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-sm-12">
            <div class="bg-light alc-box font-weight-bold shadow-alc mb-5 border-radius-15">
            <form action="#" method="POST">
                <h4 class="card-header">WALLET ADDRESS</h4>
                {{csrf_field()}}
                <div class="p-3 text-blue font-size-16">
                    <div class="form-group row">
                        <label for="" class="col-sm-3">ALC ADDRESS <span class="float-right">:</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control border-radius-22" name="anc_address" {{$account->anc_address!=null?'disabled':''}} value="{{$account->anc_address}}">
                            @if($account->anc_address==null)
                            <div class="from-group row">
                                <div class="mb-none">
                                    <label for="" class="col-sm-8">&nbsp;</label>
                                </div>
                                <div class="col-sm-3"><p></p>
                                    <button type="button" class="btn btn-warning btn-alc disabled font-weight-bold">SAVE</button>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
           </form>
        </div>
        </div>
    </div>
    <div class="row">
            <div class="col-sm-12">
            <div class="bg-light alc-box font-weight-bold shadow-alc mb-5 border-radius-15">
                <h4 class="card-header">PAYMENT INFORMATION</h4>
                <div class="p-3 text-blue font-size-16">
                <h6 class="text-primary">
                    <br>
                    PLEASE ACCURATELY COMPLETE YOUR PAYMENT INFORMATION IN THE FORM BELOW:
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
                        <label for="" class="col-sm-3">BANK NAME<span class="float-right">:</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control border-radius-22" name='bank_name' value="{{$bank->bank_name}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3">BANK BRANCH NAME <span class="float-right">:</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control border-radius-22" name='branch_name' value="{{$bank->branch_name}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3">SWIFT CODE <span class="float-right">:</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control border-radius-22" name='swift_code' value="{{$bank->swift_code}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3">BANK ADDRESS <span class="float-right">:</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control border-radius-22" name='address' value="{{$bank->address}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3">FULL NAME<span class="float-right">:</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control border-radius-22" name='full_name' value="{{$bank->full_name}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3">ACCOUNT NUMBER<span class="float-right">:</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control border-radius-22" name='account_no' value="{{$bank->account_no}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="mb-none">
                            <label for="" class="col-sm-9">&nbsp;</label>
                        </div>
                        <div class="col-sm-3">
                            <button class="btn btn-warning btn-alc font-weight-bold">SAVE</button>
                        </div>
                    </div>
                </form>
                </div>
                @else
                    <div class="p-3">
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
                                <button class="btn btn-primary btn-alc font-weight-bold">SAVE</button>
                            </div>
                        </div>
                    </form>
                    </div>
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