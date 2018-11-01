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
    <body>
    <?php $exc = DB::table('rates')->where('id',1)->first();?>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{url('/')}}">
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
                                <a class="dropdown-item" href="{{url('/dashboard')}}">Dashboard</a>
                                <a class="dropdown-item" href="{{url('/member/logout')}}">Logout</a>
                            </div>
                        </li>
                    </ul>
                    @else
                    <ul class="ml-auto navbar-nav">
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
                        <div class="col-md-8 text-justify">
                            <h5>
                                <img src="{{asset('images/alc-logo.png')}}" alt="" class="logo py-1">
                            </h5>
                            <aside>
                                Established in 2018 as investment company.  
                            </aside>
                            <aside>
                                Ana Lee Capital aim to the creation of an environment where investors are focused more on getting in an out of an E-share for quick financial gains rather than having a legitimate, vested interested and belief in the platform they are contributing financial support to.
                            </aside>
                        </div>
                        <div class="col-md-4 contact-us">
                            <h5>CONTACT US</h5>
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
                                        service@analeecapital.com
                                    </div>
                                </div>
                            </aside>
                        </div>
                    </div>
                </section>
            </div>
        </footer>
        <div class="container-fluit term-footer">
            <div class="container">
                <div class="col-md-12 py-3">
                    All Rights Reserved by ANA LEE CAPITAL Co., LTD	Privacy Policy 
                    <div>
                        <a href=""></a>
                        <i class="fa fa-facebook"></i>
                        <i class="fa fa-linkedin"></i>
                        <small>&nbsp;&nbsp; | &nbsp;&nbsp; {{date('Y-m-d H:i:s')}}</small>
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
