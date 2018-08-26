@extends('layouts.security')
@section('content')
	<h4 class="card-title">Forgot Password</h4>
	<form method="POST">
		<div class="form-group">
			<label for="email">E-Mail Address</label>
			<input id="email" type="email" class="form-control" name="email" value="" required autofocus>
			<div class="form-text text-muted">
				<small>By clicking "Reset Password" we will send a password reset link</small>
			</div>
		</div>
		<div class="form-group no-margin">
			<button type="submit" class="btn btn-learn btn-primary btn-block">
				Reset Password
			</button>
		</div>
	</form>
@endsection