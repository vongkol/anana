<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="Anana Capitals">
        <title>Anana Capitals</title>
        <link href="{{asset('fronts/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('fronts/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
        <link href="{{asset('fronts/css/clean-blog.css')}}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{asset('fronts/css/custom.css')}}">
        <link rel="stylesheet" href="{{asset('fronts/css/front-admin.css')}}">
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
                        {{session('member')->username}}
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

    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
               <h3>Main Menu</h3>
                <strong>M</strong>
            </div>

            <ul class="list-unstyled components">
                <li class="active">
                    <a href="#" class="dropdown-toggle">
                        <i class="fa fa-tachometer"></i>
                        Dashboard
                    </a>
                </li>
                
                <li>
                    <a href="#">
                        <i class="fa fa-briefcase"></i>
                        Investment
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-copy"></i>
                        Wallet
                    </a>
                </li>
               
                <li>
                    <a href="#">
                        <i class="fa fa-image"></i>
                        Network
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-question"></i>
                        Profile
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-sign-out"></i>
                        Logout
                    </a>
                </li>
            </ul>
        </nav>

        @yield('content')

        <footer>
            <div class="container">
                <section class="section2 text-center">
                    <div class="row">
                    <div class="col-md-3">
                    <h5>PRODUCTS</h5>
                    <aside>Wallet</aside>
                    <aside>Explorer</aside>
                        <aside>Principal Strategies</aside>
                        <aside>Developer</aside>
                    </div>
                <div class="col-md-3">
                    <h5>COMPANY</h5>
                    <aside>Wallet</aside>
                    <aside>Explorer</aside>
                        <aside>Principal Strategies</aside>
                        <aside>Developer</aside>
                    </div>
                <div class="col-md-3">
                    <h5>LEARN</h5>
                    <aside>Wallet</aside>
                    <aside>Explorer</aside>
                        <aside>Principal Strategies</aside>
                        <aside>Developer</aside>
                    </div>
                <div class="col-md-3">
                    <h5>DATA</h5>
                    <aside>Wallet</aside>
                    <aside>Explorer</aside>
                        <aside>Principal Strategies</aside>
                        <aside>Developer</aside>
                    </div>
                </div> 
            </section>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2 style="color:#563d7c;padding: 20px;">Anana Capitals</h2>
                    </div>
                    <div class="col-lg-8 col-md-10 mx-auto">
                        <ul class="list-inline text-center">
                        <li class="list-inline-item">
                            <a href="#">
                            <span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                            </span>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                            <span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                            </span>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                            <span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-linkedin fa-stack-1x fa-inverse"></i>
                            </span>
                            </a>
                        </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Bootstrap core JavaScript -->
        <script src="{{asset('fronts/vendor/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('fronts/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('fronts/js/clean-blog.min.js')}}"></script>
        <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
    </body>
</html>