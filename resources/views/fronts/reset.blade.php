@extends('layouts.security')
@section('content')
	<h4 class="card-title">Reset Password</h4>
	<form method="POST">
		
		<div class="form-group">
			<label for="new-password">New Password <span class="text-danger">*</span></label>
			<input id="new-password" type="password" class="form-control" name="password" required autofocus data-eye>

			<label for="new-password">Comfirm Password <span class="text-danger">*</span></label>
			<input id="new-password" type="password" class="form-control" name="password" required data-eye>
			<div class="form-text text-muted">
				<small>Make sure your password is strong and easy to remember</small>
			</div>
		</div>

		<div class="form-group no-margin">
			<button type="submit" class="btn btn-learn btn-primary btn-block">
				Reset Password
			</button>
		</div>
	</form>
@endsection