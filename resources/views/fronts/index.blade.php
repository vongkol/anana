@extends('layouts.front')
@section('content')
   <header class="masthead">
        <div class="container-fluit slideshow">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="{{asset('images/banner1.jpg')}}" alt="" width="100%">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{asset('images/banner3.jpg')}}" alt="" width="100%">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{asset('images/banner2.jpg')}}" alt="" width="100%">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </header>
    <div class="container container-c">
        <div class="row">
            <div class="col-md-12 my-4 text-center">
                <h1 class="text-warning mb-welcome-text">Welcome to Ana Lee Capital</h1> 
                <aside class="font-weight-bold">
                Your only solution to digital money, 
                turning your cryptocurrencies into real money.
                We are legit, we are solid, we are the real deal.</aside>
                <aside class="font-weight-bold">
                Cash out your cryptocurrencies with our bank partners in
                Cambodia, and count them all in your own hand. Ana Lee Capital.</aside>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <iframe class="video-ana-lee" src="https://www.youtube.com/embed/p8dzJSJZ7EE" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <div class="col-md-6">
                        <iframe class="video-ana-lee" src="https://www.youtube.com/embed/V-9FwVqhves" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div><br>
        <div class="row">
            <div class="col-md-12">
                <h2 class="post-title text-center text-warning">
                    Our Projects
                </h2>
                <hr class="hr-alc">
            </div>
            <div class="col-md-4">
                <p>
                    <img src="{{asset('images/myp6.jpg')}}" class="w-100" alt="">
                </p>
                <div class="py-3">
                    <h5>Ana Lee Hotel and Resort</h5>
                    <a href="" class=""> Read More <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-md-4">
                <p>
                    <img src="{{asset('images/myp1.jpg')}}" class="w-100" alt="">
                </p>
                <div class="py-3">
                    <h5>Glory Villa</h5>
                    <a href="" class=""> Read More <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-md-4">
                <p>
                    <img src="{{asset('images/myp2.jpg')}}" width="100%" alt="">
                </p>
                <div class="py-3">
                    <h5>Harmonize Villa</h5>
                    <a href="" class=""> Read More <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-md-4">
                <p>
                    <img src="{{asset('images/myp3.jpg')}}" width="100%" alt="">
                </p>
                <div class="py-3">
                    <h5>Grand Villa</h5>
                    <a href="" class=""> Read More <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-md-4">
                <p>
                    <img src="{{asset('images/myp4.jpg')}}" width="100%" alt="">
                </p>
                <div class="py-3">
                    <h5>Ana Lee Flat</h5>
                    <a href="" class=""> Read More <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-md-4">
                <p>
                    <img src="{{asset('images/myp5.jpg')}}" width="100%" alt="">
                </p>
                <div class="py-3">
                    <h5>Ana Lee LC</h5>
                    <a href="" class=""> Read More <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
        <div class="row my-2 pt-3">
            <div class="col-md-12">
            <h2 class="text-warning text-center">Payment Services</h2>
            <hr class="hr-alc">
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 p-2 text-center">
                <img src="{{asset('images/ababank.png')}}" alt="">
            </div>
            <div class="col-md-3 p-2 text-center">
                <img src="{{asset('images/chbank.png')}}" alt="">
            </div>
            <div class="col-md-3 p-2 text-center">
                <img src="{{asset('images/sacombank.png')}}" alt="">
            </div>
            <div class="col-md-3 p-2 text-center">
                <img src="{{asset('images/kbank.png')}}" alt="">
            </div>
        </div>
    </div> 
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d250151.4521064407!2d104.75010230732494!3d11.57933057569886!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3109513dc76a6be3%3A0x9c010ee85ab525bb!2sPhnom+Penh!5e0!3m2!1sen!2skh!4v1540554478276" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
@endsection