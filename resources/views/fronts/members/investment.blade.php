@extends('layouts.page')
@section('content')
<div class="container">
	<div class="earning-dashboard">
		<h3>
			<span class="text-warning">
			MY INVESTMENT
			</span>&nbsp;
			<a href="{{url('dashboard')}}" class="btn btn-success btn-alc"> <i class="fa fa-arrow-left"></i> Back</a>
			<hr class="hr-alc">
        </h3>
        <br>
		<div class="row">
            <div class="col-sm-4">
				 <div class="bg-light font-weight-bold shadow-alc p-3 mb-5 border-radius-15">
					<h4>INVESTMENT PACKAGE</h4>
					<hr class="hr-alc">
					<strong>
						@if($investment!=null)
						<h5><i class="fa fa-diamond"></i> {{$investment->name}}</h5>
						@endif
					</strong>
				</div>
			</div>
			<div class="col-sm-4">
				 <div class="bg-light font-weight-bold shadow-alc p-3 mb-5 border-radius-15">
					<h4>INVEST AMOUNT</h4>
					<hr class="hr-alc">
					<strong>
						@if($investment!=null)
						<h4><span class="text-warning">$</span> {{$investment->price}}</h4>
						@endif
					</strong>
				</div>
			</div>
			<div class="col-sm-4">
				 <div class="bg-light font-weight-bold shadow-alc p-3 mb-5 border-radius-15">
					<h4>MONTHLY PAYOUT RATE</h4>
					<hr class="hr-alc">
					<strong>
						@if($investment!=null)
						<h4>{{$investment->monthly_payout}} <span class="text-warning">%</span></h4>
						@endif
					</strong>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="bg-light font-weight-bold shadow-alc p-3 mb-5 border-radius-15">
					<h4>DAY OF CONTRACT</h4>
					<hr class="hr-alc">
					<strong>
						@if($investment!=null)
						<h4>{{$investment->duration}} 	<small class="text-secondary"> Days</small>	</h4>
						@endif
					</strong>
				</div>
			</div>
			<div class="col-sm-4">
				 <div class="bg-light font-weight-bold shadow-alc p-3 mb-5 border-radius-15">
					<h4>INVEST DATE</h4>
					<hr class="hr-alc">
					<strong class="text-success">
						@if($investment!=null)
							<h4>{{$investment->order_date}}</h4> 
						@endif
					</strong>
				</div>
			</div>
			<div class="col-sm-4">
				 <div class="bg-light font-weight-bold shadow-alc p-3 border-radius-15">
					<h4>EXPIRED ON</h4>
					<hr class="hr-alc">
					<strong class="text-danger">
						@if($investment!=null)
						<h4>{{$investment->expired_on}}</h4>
						@endif
					</strong>
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