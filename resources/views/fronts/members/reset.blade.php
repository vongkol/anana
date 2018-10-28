@extends('layouts.security')
@section('content')
<body class="my-login-page main-page-login">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center  h-100">
				<div class="card-wrapper">
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Reset Password</h4>
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
                           @if ($errors->any())
								<div class="alert alert-danger" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<ul>
										@foreach ($errors->all() as $error)
											<li>{{ $error }}</li>
										@endforeach
									</ul>
								</div>
							@endif
							<form method="POST" action="{{url('member/reset/save')}}">
								{{csrf_field()}}
                                <input type="hidden" value="{{$id}}" name="id">
								<div class="form-group">
									<label>New Password<span class="text-danger">*</span></label>
									<input id="password" type="password" class="form-control" name="password" value="" required autofocus>
								</div>
                                <div class="form-group">
									<label>Confirm Password<span class="text-danger">*</span></label>
									<input id="cpassword" type="password" class="form-control" name="cpassword" value="" required>
								</div>
								<div class="form-group no-margin">
									<button type="submit" class="btn-learn btn btn-dark btn-block">
										Reset Now
									</button>
								</div>
								<div class="margin-top20 text-center">
									<p>
									Back to login account!
										<a href="{{url('sign-in')}}" class="text-primary">
											Back
										</a>
									</p>
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