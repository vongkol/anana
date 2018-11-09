@extends('layouts.page')
@section('content')
<div class="container">
	<div class="earning-dashboard">
		<h3>
			<span class="text-warning">
			INVESTMENT
			</span>&nbsp;
			<a href="{{url('dashboard')}}" class="btn btn-success btn-alc"> <i class="fa fa-arrow-left"></i> Back</a>
			<hr class="hr-alc">
        </h3>
        <br>
		<div class="row">
		<div class="col-sm-4">
			<div class="bg-light alc-box text-center font-weight-bold shadow-alc mb-5 border-radius-15">
            	<h4 class="card-header">INVESTMENT PACKAGE</h4>
					@if($investment!=null)
					<h5 class="p-3 text-warning  margin-top-8  font-size-23">{{$investment->name}}</h5>
					@endif
				</div>
			</div>
			<div class="col-sm-4">
			<div class="bg-light alc-box text-center font-weight-bold shadow-alc mb-5 border-radius-15">
            	<h4 class="card-header">INVEST AMOUNT</h4>
						@if($investment!=null)
						<h5 class="p-3 text-warning  margin-top-8  font-size-23"> $ {{$investment->price}}</h5>
						@endif
					</strong>
				</div>
			</div>
			<div class="col-sm-4">
			<div class="bg-light alc-box text-center font-weight-bold shadow-alc mb-5 border-radius-15">
            	<h4 class="card-header">MONTHLY MEMBERSHIP</h4>
					@if($investment!=null)
					<h5 class="p-3 text-warning  margin-top-8  font-size-23">{{$investment->monthly_payout}} <span class="text-warning">%</span></h5>
					@endif
				</div>
			</div>
			<div class="col-sm-4">
			<div class="bg-light alc-box text-center font-weight-bold shadow-alc mb-5 border-radius-15">
            	<h4 class="card-header ">DAY OF CONTRACT</h4>
					@if($investment!=null)
					<h5 class="p-3 text-warning  margin-top-8  font-size-23">{{$investment->duration}} 	DAYS</h5>
					@endif
				</div>
			</div>
			<div class="col-sm-4">
			<div class="bg-light alc-box text-center font-weight-bold shadow-alc mb-5 border-radius-15">
            	<h4 class="card-header ">INVESTMENT DATE</h4>
					@if($investment!=null)
					<h5 class="p-3 text-warning  margin-top-8  font-size-23">{{$investment->order_date}}</h5>
					@endif
				</div>
			</div>
			<div class="col-sm-4">
				<div class="bg-light alc-box text-center font-weight-bold mb-5 shadow-alc border-radius-15">
					<h4 class="card-header ">EXPIRY</h4>
					@if($investment!=null)
					<h5 class="p-3 text-warning  margin-top-8  font-size-23">{{$investment->expired_on}}</h5>
					@endif
				</div>
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