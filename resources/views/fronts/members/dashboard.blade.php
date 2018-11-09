@extends('layouts.page')
@section('content')
    <div class="container">
		<div class="earning-dashboard">
		<h3 class="text-center"><i class="fa fa-tachometer"></i> DASHBOARD</h3>
     	<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-4 col-6">
				<a href="{{url('member/account/'.$id)}}" style="text-decoration:none;">
					<div class="box-part shadow-alc text-center">
						<img src="{{asset('images/myaccount.png')}}" width="80" alt="">
						<div class="title">
							<h4 class="mobile-font-h4">MY ACCOUNT</h4>
						</div>
					</div>
				</a>
			</div>	 
			<div class="col-lg-4 col-md-4 col-sm-4 col-6">
				<a href="{{url('member/investment/'.$id)}}"  style="text-decoration:none;">
					<div class="box-part shadow-alc text-center">
						<img src="{{asset('images/invesment.png')}}" width="80" alt="">
						<div class="title">
							<h4 class="mobile-font-h4">INVESMENT</h4>
						</div>
					</div>
				</a>
			</div>	 
				<div class="col-lg-4 col-md-4 col-sm-4 col-6">
				<a href="{{url('member/earning')}}"style="text-decoration:none;">
					<div class="box-part shadow-alc text-center">
						<img src="{{asset('images/earning.png')}}" width="80" alt="">
						<div class="title">
							<h4 class="mobile-font-h4">EARNING</h4>
						</div>
					</div>
				</a>
			</div>	 
			<div class="col-lg-4 col-md-4 col-sm-4 col-6">
				<a href="{{url('member/network')}}" style="text-decoration:none;">
					<div class="box-part shadow-alc text-center">
						<img src="{{asset('images/mynetwork.png')}}" width="80" alt="">
						<div class="title">
							<h4 class="mobile-font-h4">MY NETWORK</h4>
						</div>  
					</div>
				</a>
			</div>	 
				<div class="col-lg-4 col-md-4 col-sm-4 col-6">
				<a href="{{url('member/transaction')}}" style="text-decoration:none;">
					<div class="box-part shadow-alc text-center">
						<img src="{{asset('images/transactions.png')}}" width="80" alt="">
						<div class="title">
							<h4 class="mobile-font-h4">TRANSACTION</h4>
						</div>
					</div>
				</a>
			</div>	 
				<!-- <div class="col-lg-4 col-md-4 col-sm-4 col-6">
				<a href="{{asset('terms-conditions.pdf')}}" class="text-primary" style="text-decoration:none;">
					<div class="box-part text-center">
						<img src="{{asset('images/termandcondiction.png')}}" width="77" alt="">
						<div class="title">
							<h4 class="mobile-font-h4">Terms & Conditions</h4>
						</div>
					</div>
				</a>
			</div> -->
		</div>		
    </div>
</div>
@endsection