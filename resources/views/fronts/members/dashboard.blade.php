@extends('layouts.page')
@section('content')
<div class="box">
    <div class="container">
		<h3 class="text-center"><i class="fa fa-tachometer"></i> Dashboard</h3>
     	<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-4 col-6">
				<a href="{{url('member/account/'.session('member')->id)}}" class="text-primarye" style="text-decoration:none;">
					<div class="box-part text-center">
						<img src="{{asset('images/myaccount.png')}}" width="80" alt="">
						<div class="title">
							<h4 class="mobile-font-h4">My Account</h4>
						</div>
					</div>
				</a>
			</div>	 
			<div class="col-lg-4 col-md-4 col-sm-4 col-6">
				<a href="{{url('member/investment/'.session('member')->id)}}" class="text-primary" style="text-decoration:none;">
					<div class="box-part text-center">
						<img src="{{asset('images/invesment.png')}}" width="80" alt="">
						<div class="title">
							<h4 class="mobile-font-h4">Investment</h4>
						</div>
					</div>
				</a>
			</div>	 
				<div class="col-lg-4 col-md-4 col-sm-4 col-6">
				<a href="{{url('member/earning')}}" class="text-primary" style="text-decoration:none;">
					<div class="box-part text-center">
						<img src="{{asset('images/earning.png')}}" width="80" alt="">
						<div class="title">
							<h4 class="mobile-font-h4">Earning</h4>
						</div>
					</div>
				</a>
			</div>	 
			<div class="col-lg-4 col-md-4 col-sm-4 col-6">
				<a href="{{url('member/network')}}" class="text-primary" style="text-decoration:none;">
					<div class="box-part text-center">
						<img src="{{asset('images/mynetwork.png')}}" width="80" alt="">
						<div class="title">
							<h4 class="mobile-font-h4">My Network</h4>
						</div>  
					</div>
				</a>
			</div>	 
				<div class="col-lg-4 col-md-4 col-sm-4 col-6">
				<a href="{{url('member/transaction')}}" class="text-primary" style="text-decoration:none;">
					<div class="box-part text-center">
						<img src="{{asset('images/transactions.png')}}" width="80" alt="">
						<div class="title">
							<h4 class="mobile-font-h4">Transactions</h4>
						</div>
					</div>
				</a>
			</div>	 
				<div class="col-lg-4 col-md-4 col-sm-4 col-6">
				<a href="{{url('term')}}" class="text-primary" style="text-decoration:none;">
					<div class="box-part text-center">
						<img src="{{asset('images/termandcondiction.png')}}" width="77" alt="">
						<div class="title">
							<h4 class="mobile-font-h4">Terms & Conditions</h4>
						</div>
					</div>
				</a>
			</div>
		</div>		
    </div>
</div>
@endsection