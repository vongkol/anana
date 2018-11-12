@extends('layouts.page')
@section('content')
<div class="container">
    <div class="earning-dashboard">
    <h3 class="text-warning">TRANFTER TO ANY R-WALLET &nbsp;
        <a href="{{url('member/earning')}}" class="btn btn-success btn-alc">
      <i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a>
    <hr class="hr-alc">
    </h3>
    <br>
    <div class="row">
        <div class="col-sm-12 font-size-16 text-blue font-weight-bold">
            <div class="bg-light font-weight-bold alc-box mb-5 font-size-16  text-blue shadow-alc p-3 border-radius-15">
                <div class="p-3">  
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
            <form action="{{url('member/transfer/anyregister/save')}}" method="POST" id="frm">
                {{csrf_field()}}
                <div class="form-group row">
                    <label for="" class="control-label col-sm-3">R-WALLET AMOUNT &nbsp;( USD )</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control border-radius-22" readonly 
                            value="{{\App\Http\Controllers\Helper::encryptor('decrypt', $member->register_wallet)}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="control-label col-sm-3">RECEIVED USER<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control border-radius-22" name="account" required id="account">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="control-label col-sm-3">TRANSFER AMOUNT<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control border-radius-22" name="amount" id="amount"
                            placeholder="USD" min="1" step="0.001" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="control-label col-sm-3">SECURITY PIN<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control border-radius-22" placeholder="****" name="pin" id="pin" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="control-label col-sm-9 mb-none">&nbsp;</label>
                    <div class="col-sm-3">
                        <button class="btn btn-warning btn-alc font-weight-bold" type="button" id="btn">TRANSFER</button>
                    </div>
                </div>
            </form>
            </div></div>        
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">RECEIVED USER INFORMATION</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-sm-4"><strong>Full Name</strong></div>
            <div class="col-sm-8"><strong class="text-danger" id='fname'></strong></div>
        </div>
        <div class="row">
            <div class="col-sm-4"><strong>Username</strong></div>
            <div class="col-sm-8"><strong class="text-danger" id='username'></strong></div>
        </div>
        <div class="row">
            <div class="col-sm-4"><strong>Email</strong></div>
            <div class="col-sm-8"><strong class="text-danger" id='email'></strong></div>
        </div>
        <div class="row">
            <div class="col-sm-4"><strong>Phone</strong></div>
            <div class="col-sm-8"><strong class="text-danger" id='phone'></strong></div>
        </div>
        <div class="row">
            <div class="col-sm-4"><strong>Country</strong></div>
            <div class="col-sm-8"><strong class="text-danger" id='country'></strong></div>
        </div>
        <div class="row">
            <div class="col-sm-4"><strong>Transfer Amount</strong></div>
            <div class="col-sm-8"><strong class="text-danger" id='tamount'></strong></div>
        </div>
      </div>
      <div class="modal-footer">
       
        <button type="button" class="btn btn-warning btn-alc font-weight-bold" id="btn1">CONFIRM</button>
         <button type="button" class="btn btn-secondary btn-alc font-weight-bold" data-dismiss="modal">CANCEL</button>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
    <script>
        var burl = "{{url('/')}}";
        $(document).ready(function(){
            
            $('#btn').click(function(){
                var username = $("#account").val();
                var pin = $("#pin").val();
                var amount = $("#amount").val();
                if(username=='')
                {
                    alert('Received user is required!');
                }
                else if(pin=='')
                {
                    alert('Security PIN is required!');
                }
                else if(amount<=0)
                {
                    alert('Amount is required!');
                }
                else{
                    $.ajax({
                        type: "GET",
                        url: burl + "/member/receiver/get/" + username,
                        success: function(data){
                            data = JSON.parse(data);
                            $("#exampleModal").modal('show');
                            $('#fname').html(": " + data.full_name);
                            $("#username").html(": " + data.username);
                            $("#email").html(": " + data.email);
                            $("#phone").html(": " + data.phone);
                            $("#country").html(": " + data.country);
                            $("#tamount").html(": $ " + amount);
                        }
                    });
                }
                
            });
            $("#btn1").click(function(){
                $("#frm").submit();
            });
        });
    </script>
@endsection