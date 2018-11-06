@extends('layouts.page')
@section('content')
<div class="container">
	<div class="earning-dashboard">
		<h3>
			<img src="{{asset('images/invesment.png')}}" alt="" width="50"> 
			My Investment 
			<a href="{{url('dashboard')}}" class="btn btn-success btn-sm"> <i class="fa fa-arrow-left"></i> Back</a>
        </h3>
        <p></p>
		<div class="row">
            <div class="col-sm-2 col-6">
                <hr>
                <h6>Investment Package</h4>
                <hr>
                <strong>
					@if($investment!=null)
					<i class="fa fa-gift text-warning"></i> {{$investment->name}}
					@endif
				</strong>
                <p></p>
			</div>
			<div class="col-sm-2 col-6">
                <hr>
                <h6>IInvest Amount</h4>
                <hr>
                <strong>
					@if($investment!=null)
						$ {{$investment->price}}
					@endif
				</strong>
                <p></p>
			</div>
			<div class="col-sm-2 col-6">
                <hr>
                <h6>Monthly Payout Rate</h4>
                <hr>
                <strong>
					@if($investment!=null)
						{{$investment->monthly_payout}} %
					@endif
				</strong>
                <p></p>
			</div>
			<div class="col-sm-2 col-6">
                <hr>
                <h6>Day Of Contract</h4>
                <hr>
                <strong>
					@if($investment!=null)
						{{$investment->duration}}
					@endif
				</strong>
                <p></p>
			</div>
			<div class="col-sm-2 col-6">
                <hr>
                <h6>Invest Date</h4>
                <hr>
                <strong class="text-success">
					@if($investment!=null)
						{{$investment->order_date}}
					@endif
				</strong>
                <p></p>
			</div>
			<div class="col-sm-2 col-6">
                <hr>
                <h6>Expired On</h4>
                <hr>
                <strong class="text-danger">
					@if($investment!=null)
						{{$investment->expired_on}}
					@endif
				</strong>
                <p></p>
			</div>
		</div>
        @if($investment==null)
			<p class="text-center text-danger">You don't have an investment yet. <br>
				<a href="{{url('member/investment/start')}}" class="btn btn-warning btn-sm">Start Investment Now</a>
			</p>
		@endif

	</div>
</div>
@stop