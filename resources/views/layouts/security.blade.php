<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<title>NANAPAYMENT</title>
    <link href="{{asset('fronts/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('fronts/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="{{asset('fronts/css/custom.css')}}">
     <link rel="stylesheet" type="text/css" href="{{asset('fronts/css/login.css')}}">
</head>
<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center  h-100">
				<div class="card-wrapper">
					<div class="brand text-center">
						<a href="{{url('/')}}">
							<h4 class="text-white"><b>ANANA CAPITAl</b></h4>
						</a>
					</div>
					<div class="card fat">
						<div class="card-body">
							@yield('content')
						</div>
					</div>	
				</div>
			</div>
		</div>
	</section>
    <script src="{{asset('fronts/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('fronts/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('fronts/js/login.js')}}"></script>
</body>
</html>