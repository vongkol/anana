<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="sor vichey">
        <title>Ana Lee Capital</title>
        <link href="{{asset('fronts/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('fronts/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
        <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicon-32x32.png')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('fronts/css/custom.css')}}">
    </head>
    <body  onload=display_ct();>
        <?php $exc = DB::table('rates')->where('id',1)->first();?>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container-fluid">
                @if(Session::has('member'))
                <a class="navbar-brand" href="{{url('/dashboard')}}">
                @else
                <a class="navbar-brand" href="{{url('/')}}">
                @endif
                <img src="{{asset('images/alc-logo.png')}}" alt="" class="logo py-1">
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
                        <a href="{{url('page/about')}}" class="nav-link">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('page/white-paper')}}" class="nav-link">White Paper</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('investment')}}" class="nav-link">Investment</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('page/contact')}}" class="nav-link">Contact Us</a>
                    </li>
                </ul>
                @if(Session::has('member'))
                <ul class="ml-auto navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{asset('images/level/'. session('member')->photo)}}" width="40" alt=""> {{session('member')->username}}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{url('/dashboard')}}">Dashboard</a>
                                <a class="dropdown-item" href="{{url('/member/logout')}}">Logout</a>
                            </div>
                        </li>
                    </ul>
                @else
                <ul class="ml-auto navbar-nav px-2">
                    <li class="nav-item mt-3 mb-3 pr-2"> <span class="text-white font-weight-bold">1 ALC = <span class="text-warning">USD {{$exc->rate}}</span></span>
                        <div class="dropdown">
                            <button type="button" class="btn btn-outline-secondary language dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-globe" aria-hidden="true"></i> Language
                            </button>
                            <div class="dropdown-menu dropdown-menu-c">
                                <a class="dropdown-item dropdown-item-c" href="#">English</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item mt-3 mb-3">
                        <a href="{{url('sign-in')}}" class="btn btn-outline-dark">
                            Login
                        </a>
                        <a href="{{url('sign-up')}}" class="btn btn-outline-dark">
                            Sign Up
                        </a>
                    </li>
                </ul>
                @endif
                </div>
            </div>
        </nav>
        @yield('content')
        <script type="text/javascript"> 
            function display_c(){
            var refresh=1000; // Refresh rate in milli seconds
            mytime=setTimeout('display_ct()',refresh)
            }

            function display_ct() {
            var x = new Date()
            var x1=x.getMonth() + 1+ "/" + x.getDate() + "/" + x.getFullYear(); 
            x1 = x1 + " - " +  x.getHours( )+ ":" +  x.getMinutes() + ":" +  x.getSeconds();
            document.getElementById('ct').innerHTML = x1;
            display_c();
            }
        </script>
        <div class="container-fluit term-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 py-3">
                        Copyright &copy; ANA LEE CAPITAL (ALC). All rights reserved. <span class="text-warning"> | </span> <a href="{{asset('privacy.pdf')}}">Privacy Policy </a>
                        <div>
                            <a href="https://www.facebook.com/analeecapital/" class="btn btn-outline-warning btn-sm pt-0 pb-0 mt-1" target="_blank">
                                <i class="fa fa-facebook"></i>
                            </a>
                            <a href="#" class="btn btn-outline-warning btn-sm pt-0 pb-0 mt-1" target="_blank">
                                <i class="fa fa-linkedin"></i>
                            </a>
                            <small class="mt-1">&nbsp;&nbsp; | &nbsp;&nbsp; <span id='ct' ></span></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{asset('fronts/vendor/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('fronts/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('fronts/js/clean-blog.min.js')}}"></script>
    </body>
</html>
