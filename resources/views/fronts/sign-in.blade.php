@extends('layouts.security')
@section('content')
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
			<label for="id">Email <span class="text-danger">*</span></label>
			<input id="email" type="email" class="form-control" name="email" value="" required autofocus>
			
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
			<button type="submit" class="btn-learn btn btn-primary btn-block">
				Login
			</button>
		</div>
		<div class="margin-top20 text-center">
			Don't have an account? <a href="{{url('sign-up')}}">Click here to sign up!</a>
		</div>
	</form>
@endsection