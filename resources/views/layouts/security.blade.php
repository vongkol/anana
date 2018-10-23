<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="sorvichey">
        <title>Anana Capitals</title>
        <link href="{{asset('fronts/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('fronts/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
		<link href="{{asset('fronts/css/clean-blog.css')}}" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="{{asset('fronts/css/custom.css')}}">
		<link rel="stylesheet" href="{{asset('fronts/css/page.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('fronts/css/login.css')}}">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{url('/')}}">
                    <img src="{{asset('images/logo.png')}}" alt="Anana Capital" width="90"> Anana Capital
                </a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fa fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="{{url('/')}}" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('investment')}}" class="nav-link">Investment</a>
                    </li>
                   
                    <li class="nav-item">
                        <a href="#" class="nav-link">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Contact Us</a>
                    </li>
                   
                </ul>
                @if(Session::has('member'))
                <ul class="ml-auto navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{session('member')->first_name .' '. session('member')->last_name}}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="{{url('/dashboard')}}">Dashboard</a>
                            <a class="dropdown-item" href="{{url('/member/logout')}}">Logout</a>
                        </div>
                    </li>
                </ul>
                @else
                <ul class="ml-auto">
                    <a href="{{url('sign-in')}}" class="btn btn-outline-dark flat">
                        Login
                    </a>
                    <a href="{{url('sign-up')}}" class="btn btn-outline-dark flat">
                        Sign Up
                    </a>
                </ul>
                @endif
                </div>
            </div>
        </nav>

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
	@yield('js')
</body>
</html>