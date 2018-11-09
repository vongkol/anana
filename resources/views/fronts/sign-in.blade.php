@extends('layouts.security')
@section('content')
<body class="my-login-page main-page-login">
	<div class="bg-login">
		<div class="layer-login">
				<div class="container">
					<div class="row justify-content-md-center login">
						<div class="card-wrapper">
							<div class="card box-part  alc-box fat">
								<div class="card-body">
									<h4 class="card-title">Login to ANA LEE CAPITAL</h4>
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
									<form method="POST" action="{{url('member/signin')}}">
										{{csrf_field()}}
										<div class="form-group">
											<label>Username<span class="text-danger">*</span></label>
											<input id="username" type="username" class="form-control border-radius-22" name="username" value="" required autofocus>
										</div>
										<div class="form-group">
											<label for="password">Password<span class="text-danger">*</span></label>
											<input id="password" type="password" class="form-control form-control border-radius-22" name="password" required data-eye>
										</div>
										<div class="form-group no-margin">
											<button type="submit" class="btn-learn btn btn-warning border-radius-22 btn-block">
												Login
											</button>
										</div>
										<div class="margin-top20 text-center">
											Don't have an account? <a href="{{url('sign-up')}}" class="text-info">Click here to sign up!</a>
											<p>
												Forget your password? 
												<a href="{{url('/member/recovery')}}" class="text-primary">
													Reset password!
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
	</div>
</div>
@endsection