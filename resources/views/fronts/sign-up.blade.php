@extends('layouts.security')
@section('content')
	<small>Sign up for a free wallet below</small>
	<h4 class="card-title">Create your Wallet</h4>
	<form method="POST">
		<div class="form-group">
			<label for="email">Email <span class="text-danger">*</span></label>
			<input id="email" type="email" class="form-control" name="email" required autofocus>
		</div>
		<div class="form-group">
			<label for="country">Country <span class="text-danger">*</span></label>
			<select class="form-control">
				<option>Contries</option>
			</select>
		</div>
		<div class="form-group">
			<label for="password">New Password <span class="text-danger">*</span></label>
			<input id="password" type="password" class="form-control" name="password"  required  data-eye>
		</div>
		<div class="form-group">
			<label for="password">Confirm Password <span class="text-danger">*</span></label>
			<input id="password" type="password" class="form-control" name="password" required data-eye>
		</div>
		<div class="form-group">
			<label>
				<input type="checkbox" name="aggree" value="1"> <small>I have read and agree to the <a href="" class="text-primary">Terms of Service</small></a>
			</label>
		</div>
		<div class="form-group no-margin">
			<button type="submit" class="btn btn-learn btn-primary btn-block">
				CONTINUE
			</button>
		</div>
		<div class="margin-top20 text-center">
			Already have an account? <a href="{{url('sign-in')}}">Sign In</a>
		</div>
	</form>
@endsection