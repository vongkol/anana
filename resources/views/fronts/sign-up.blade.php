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

							<?php
								$countries = DB::table('countries')->orderBy('name')->get();
							?>
							<form method="POST" action="{{url('/member/register')}}">
								{{csrf_field()}}
								
								<div class="form-group">
									<div class="row">
										<div class="col-md-4 px-1">
											<label for="first_name">First Name <span class="text-danger">*</span></label>
											<input id="first_name" type="text" class="form-control" name="first_name" required autofocus value="{{old('first_name')}}">
										</div>
										<div class="col-md-4 px-1">
											<label for="last_name">Last Name <span class="text-danger">*</span></label>
											<input id="last_name" type="last_name" class="form-control" name="last_name" required value="{{old('last_name')}}">
										</div>
										<div class="col-md-4 px-1">
											<label for="">Gender <span class="text-danger">*</span></label>
											<select name="gender" id="gender" class="form-control">
												<option value="Male">Male</option>
												<option value="Female">Female</option>
											</select>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
									
										<div class="col-md-4 px-1">
											<label for="">Phone</label>
											<input type="text" class="form-control" id="phone" name="phone" value="{{old('phone')}}">
										</div>
										<div class="col-md-4 px-1">
											<label for="">City</label>
											<input type="text" class="form-control" id="city" name="city" value="{{old('city')}}">
										</div>
										<div class="col-md-4 px-1">
											<label for="country">Country <span class="text-danger">*</span></label>
											<select class="form-control">
												@foreach($countries as $c)
													<option value="{{$c->id}}">{{$c->name}}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
									
										<div class="col-md-4 px-1">
											<label for="">Email <span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="email" id="email" required value="{{old('email')}}">
										</div>
										<div class="col-md-4 px-1">
											<label for="password">New Password <span class="text-danger">*</span></label>
											<input id="password" type="password" class="form-control" name="password"  required  data-eye>
										</div>
										<div class="col-md-4 px-1">
											<label for="cpassword">Confirm Password <span class="text-danger">*</span></label>
											<input id="cpassword" type="password" class="form-control" name="cpassword" required data-eye>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label>
										<input type="checkbox" name="agree" value="1" id='agree'> <small>I have read and agree to the <a href="#" class="text-primary">Terms of Service</small></a>
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