@extends('layouts.security')
@section('content')
<body class="my-login-page main-page-login">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center  h-100">
				<div class="card-wrapper">
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Signin to Anana Capitals</h4>
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

							<form method="POST" action="{{url('member/signin')}}">
								{{csrf_field()}}
								<div class="form-group">
									<label>Username <span class="text-danger">*</span></label>
									<input id="username" type="username" class="form-control" name="username" value="" required autofocus>
									
								</div>
								<div class="form-group">
									<label for="password">Password <span class="text-danger">*</span>
										<a href="{{url('forgot-password')}}" class="float-right">
											Forgot Password?
										</a>
									</label>
									<input id="password" type="password" class="form-control" name="password" required data-eye>
								</div>
								<div class="form-group no-margin">
									<button type="submit" class="btn-learn btn btn-dark btn-block">
										Login
									</button>
								</div>
								<div class="margin-top20 text-center">
									Don't have an account? <a href="{{url('sign-up')}}">Click here to sign up!</a>
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