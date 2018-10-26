@extends('layouts.security')
@section('content')
<body class="my-login-page my-sign-up main-page-login">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center  h-100">
				<div class="card-wrapper">
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Sign Up</h4>
							<hr>
							
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
						
							<?php
								$countries = DB::table('countries')->orderBy('name')->get();
							?>
							<form method="POST" action="{{url('/member/register')}}">
								{{csrf_field()}}
								<div class="form-group row">
									<div class="col-md-6">
										<label>
											<strong>Sponsor ID</strong>
											<input type="text" class="form-control" name="sponsor_id" value="{{$sponsor_id}}">
										</label>
									</div>
									<div class="col-md-6">
										<label for="">
											<strong>Full Name <span class="text-danger">*</span></strong>
											<input type="text" class="form-control" required autofocus name="full_name" value="{{old('full_name')}}">
										</label>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-6">
										<label for="">
											<strong>Username <span class="text-danger">*</span></strong>
											<input type="text" class="form-control" required name="username" value="{{old('username')}}">
										</label>
									</div>
									<div class="col-md-6">
										<label for="">
											<strong>Email <span class="text-danger">*</span></strong>
											<input type="email" class="form-control" required name="email" value="{{old('email')}}">
										</label>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-6">
										<label for="">
											<strong>Phone </strong>
											<input type="text" class="form-control" name="phone" value="{{old('phone')}}">
										</label>
									</div>
									<div class="col-md-6">
										<label for="">
											<strong>Country <span class="text-danger">*</span> </strong>
											<select name="country" id="country" class="form-control">
												@foreach($countries as $c)
													<option value="{{$c->name}}">{{$c->name}}</option>
												@endforeach
											</select>
										</label>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-6">
										<label for="">
											<strong>Password <span class="text-danger">*</span> </strong>
											<input type="password" class="form-control" name="password" required value="{{old('password')}}">
										</label>
									</div>
									<div class="col-md-6">
										<label for="">
											<strong>Confirm Password <span class="text-danger">*</span> </strong>
											<input type="password" class="form-control" name="cpassword" required>
										</label>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-12">
										<label for="">
											<strong>Security PIN <span class="text-danger">*</span> </strong>
											<input type="password" class="form-control" name="security_pin" required value="{{old('security_pin')}}">
										</label>
									</div>
								</div>
								<div class="form-group">
									<label for=""><strong>Terms and Conditions</strong></label>
									<textarea name="term" id="term" cols="30" rows="5" class="form-control" readonly>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id, aut error! Odio ipsum voluptatem facere.</textarea>
								</div>
								<div class="form-group">
									<label>
										<input type="checkbox" name="agree" value="1" id='agree'> <small>I have read and agreed to the Terms and Conditions</small></a>
									</label>
								</div>
								<div class="form-group no-margin">
									<button type="submit" class="btn btn-learn btn-primary btn-block" disabled id="btnSubmit">
										Sign Up Now
									</button>
								</div>
								<div class="margin-top20 text-center">
									Already have an account? <a href="{{url('sign-in')}}">Sign In</a>
								</div>
							</form>
							</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
@section('js')
<script>
	$(document).ready(function(){
		$("#agree").change(function(){
			var val = this.checked;
			if(val)
			{
				$("#btnSubmit").removeAttr("disabled");
			}
			else{
				$("#btnSubmit").attr("disabled", "disabled");
			}
		});
	});
</script>
@endsection	