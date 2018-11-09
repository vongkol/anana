@extends('layouts.page')
@section('content')
    <div class="container">
		<div class="earning-dashboard">
		<h3>
			<span class="text-warning">DASHBOARD</span> &nbsp;
			<hr class="hr-alc">
		</h3>
		<br>
     	<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-4 col-6">
				<a href="{{url('member/account/'.$id)}}" style="text-decoration:none;">
					<div class="box-part shadow-alc  text-center">
						<img src="{{asset('images/myaccount.png')}}" width="80" alt="">
						<div class="title"><br>
							<h4 class="mobile-font-h4 alc-color">MY ACCOUNT</h4>
						</div>
					</div>
				</a>
			</div>	 
			<div class="col-lg-4 col-md-4 col-sm-4 col-6">
				<a href="{{url('member/investment/'.$id)}}"  style="text-decoration:none;">
					<div class="box-part shadow-alc  text-center">
						<img src="{{asset('images/invesment.png')}}" width="80" alt="">
						<div class="title"><br>
							<h4 class="mobile-font-h4 alc-color">INVESMENT</h4>
						</div>
					</div>
				</a>
			</div>	 
				<div class="col-lg-4 col-md-4 col-sm-4 col-6">
				<a href="{{url('member/earning')}}"style="text-decoration:none;">
					<div class="box-part shadow-alc  text-center">
						<img src="{{asset('images/earning.png')}}" width="80" alt="">
						<div class="title"><br>
							<h4 class="mobile-font-h4 alc-color">EARNING</h4>
						</div>
					</div>
				</a>
			</div>	 
			<div class="col-lg-4 col-md-4 col-sm-4 col-6">
				<a href="{{url('member/network')}}" style="text-decoration:none;">
					<div class="box-part shadow-alc text-center">
						<img src="{{asset('images/mynetwork.png')}}" width="65"  height="77" alt="">
						<div class="title"><br>
							<h4 class="mobile-font-h4 alc-color">NETWORK</h4>
						</div>  
					</div>
				</a>
			</div>	 
			<div class="col-lg-4 col-md-4 col-sm-4 col-6">
				<a href="{{url('member/transaction')}}" style="text-decoration:none;">
					<div class="box-part shadow-alc  text-center">
						<img src="{{asset('images/transactions.png')}}" width="80" alt="">
						<div class="title"><br>
							<h4 class="mobile-font-h4 alc-color">TRANSACTION</h4>
						</div>
					</div>
				</a>
			</div>	 
			<div class="col-lg-4 col-md-4 col-sm-4 col-6">
				<a href="{{asset('terms-conditions.pdf')}}" class="text-primary" style="text-decoration:none;">
					<div class="box-part shadow-alc mb-5  text-center">
						<img src="{{asset('images/termandcondiction.png')}}" width="76" alt="">
						<div class="title"><br>
							<h4 class="mobile-font-h4 alc-color">NEWS</h4>
						</div>
					</div>
				</a>
			</div>
		</div>		
    </div>
</div>
@endsection