@extends('layouts.page')
@section('content')
<body class="my-login-page main-page-login">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center  h-100">
				<div class="card-wrapper">
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Recovery password </h4>
							<hr>
							<form action="#">
								<div class="form-group">
									{{$sms}}
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