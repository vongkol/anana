@extends('layouts.security')
@section('content')
	<small>Sign in to your wallet below</small>
	<h4 class="card-title">Welcome Back</h4>
	<form method="POST">
		<div class="form-group">
			<label for="id">Wallet ID</label>
			<input id="text" type="text" class="form-control" name="id" value="" required autofocus>
			<small class="text-secondary">Find the login link in your email, e.g. nanapayment.info/wallet/1111-222-333... The series of numbers and dashes at the end of the link is your Wallet ID.</small>
		</div>
		<div class="form-group">
			<label for="password">Password
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
			Don't have an account? <a href="{{url('sign-up')}}">Sign Up</a>
		</div>
	</form>
@endsection