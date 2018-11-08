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
        <link rel="stylesheet" type="text/css" href="{{asset('fronts/css/custom.css')}}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicon-32x32.png')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('fronts/css/page.css')}}">
    </head>
    <body onload=display_ct();>
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
                            <a href="{{url('/dashboard')}}" class="nav-link">Dashboard</a>
                        </li>
                         <li class="nav-item">
                            <a href="{{url('member/account/'. \App\Http\Controllers\Helper::encryptor('encrypt', session('member')->id))}}" class="nav-link">My Account</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('member/investment/'. \App\Http\Controllers\Helper::encryptor('encrypt', session('member')->id))}}" class="nav-link">Investment</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('member/earning')}}" class="nav-link">Earning</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('member/network')}}" class="nav-link">Network</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('member/transaction')}}" class="nav-link">Transaction</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link text-white bg-secondary">1 ALC = <span class="text-warning">USD {{$exc->rate}}</span></a>
                        </li>
                    </ul>
                    @if(Session::has('member'))
                    <ul class="ml-auto navbar-nav">
                        <li class="nav-item dropdown">
                        
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{asset('images/level/'. session('member')->photo)}}" width="40" alt=""> {{session('member')->username}}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <!-- <a class="dropdown-item" href="{{url('/dashboard')}}">Dashboard</a> -->
                                <a class="dropdown-item" href="{{url('/member/logout')}}">Logout</a>
                            </div>
                        </li>
                    </ul>
                    @else
                    <ul class="ml-auto navbar-nav">
                        <li class="nav-item mt-3 mb-3 pr-2">
                            <div class="dropdown">
                                <button type="button" class="btn btn-outline-secondary language dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-globe" aria-hidden="true"></i> Language
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">English</a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item mt-3 mb-3">
                            <a href="{{url('sign-in')}}" class="btn btn-outline-dark flat">
                                Login
                            </a>
                            <a href="{{url('sign-up')}}" class="btn btn-outline-dark flat">
                                Sign Up
                            </a>
                        </li>
                    </ul>
                    @endif
                </div>
            </div>
        </nav>
        <div class="main-page">
            @yield('content')
        </div>
        <footer>
            <div class="container">
                <section class="text-white">
                    <div class="row">
                        <div class="col-md-9 text-justify">
                            <h>
                                <img src="{{asset('images/alc-logo.png')}}" alt="" class="logo py-1">
                            </h5>
                            <aside>
                                We are the first authorized and legal cryptocurrency representative in Cambodia.
                                Digital Currency is taking the world by storm because It is not just the next big thing,
                                it is THE BING THINGS. With Blockchain technology, fraud, embezzlement and other crooked 
                                activities in business transaction is no more because it is a peer to peer, network to network where no one can break it. 
                                This blockchain technology is now being used across the world as means of money transfer, 
                                crowd funding, payment and more.
                            </aside>
                            <aside>
                                Want to become our members in this exciting journey to generate more income, Ana Lee can help you achieve your dream goal.
                                If you are already a Blockchain members, we can help you to get your real cash with our partners in Cambodia.
                            </aside>
                        </div>
                        <div class="col-md-3 contact-us">
                            <h6>CONTACT US</h6>
                            <aside> 
                                #A3, St.BT, Sangkat Chomchaov, Khan Porsenchey, Phnom Penh, Cambodia
                            </aside>
                            <aside class="col-md-12 ">
                                <div class="row">
                                    <div>
                                    Email:
                                    </div>
                                    <div class="px-2">
                                        support@analeecapital.com <br>
                                        sales@analeecapital.com
                                    </div>
                                </div>
                            </aside>
                        </div>
                    </div>
                </section>
            </div>
        </footer>
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
                <div class="col-md-12 py-3">
                    Copyright &copy; ANA LEE CAPITAL (ALC). All rights reserved. <span class="text-warning"> | </span> <a href="{{asset('privacy.pdf')}}">Privacy Policy </a>
                    <div>
                        <a href=""></a>
                        <i class="fa fa-facebook"></i>
                        <i class="fa fa-linkedin"></i>
                        <small>&nbsp;&nbsp; | &nbsp;&nbsp; <span id='ct' ></span></small>
                    </div>
                </div>
            </div>
        </div>
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
