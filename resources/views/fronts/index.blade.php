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
                        <img class="d-block w-100" src="{{asset('images/banner.jpg')}}" alt="" width="100%">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100" src="{{asset('images/banner.jpg')}}" alt="" width="100%">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100" src="{{asset('images/banner.jpg')}}" alt="" width="100%">
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
    <div class="container-fluit set-wallets">
        <section class="container text-center font-weight-bold">
            <div class="row">
                <div class="col-md-3"></div>
            </div>
        </section>
    </div>
    <div class="container container-c">
        <div class="row">
            <div class="col-md-12 my-4 text-center">
                <h2 class="text-warning">Welcome to Ana Lee Capital</h2> 
                <aside>
                Your only solution to digital money, 
                turning your cryptocurrencies into real money.
                We are legit, we are solid, we are the real deal.</aside>
                <aside>
                Cash out your cryptocurrencies with our bank partners in
                Cambodia, and count them all in your own hand. Ana Lee Capital.</aside>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <iframe class="video-ana-lee" src="https://www.youtube.com/embed/MAjtMkvgiVc" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <div class="col-md-6">
                        <iframe class="video-ana-lee" src="https://www.youtube.com/embed/MAjtMkvgiVc" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container my4 container-c">
        <div class="row">
            <div class="col-md-12">
            <h2 class="post-title text-primary">
                       Our Projects
                    </h2>
                   <hr>
            </div>
            <div class="col-md-4">
                <p>
                    <img src="{{asset('images/myp6.jpg')}}" class="w-100" alt="">
                </p>
                <div class="py-3">
                    <h5 class="text-primary">Ana Lee Hotel and Resort</h5>
                    <a href="" class=""> Read More <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-md-4">
                <p>
                    <img src="{{asset('images/myp1.jpg')}}" class="w-100" alt="">
                </p>
                <div class="py-3">
                    <h5 class="text-primary">Glory Villa</h5>
                    <a href="" class=""> Read More <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-md-4">
                <p>
                    <img src="{{asset('images/myp2.jpg')}}" width="100%" alt="">
                </p>
                <div class="py-3">
                    <h5 class="text-primary">Harmonize Villa</h5>
                    <a href="" class=""> Read More <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-md-4">
                <p>
                    <img src="{{asset('images/myp3.jpg')}}" width="100%" alt="">
                </p>
                <div class="py-3">
                    <h5 class="text-primary">Grand Villa</h5>
                    <a href="" class=""> Read More <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-md-4">
                <p>
                    <img src="{{asset('images/myp4.jpg')}}" width="100%" alt="">
                </p>
                <div class="py-3">
                    <h5 class="text-primary">Shop House</h5>
                    <a href="" class=""> Read More <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-md-4">
                <p>
                    <img src="{{asset('images/myp5.jpg')}}" width="100%" alt="">
                </p>
                <div class="py-3">
                    <h5 class="text-primary">Link House</h5>
                    <a href="" class=""> Read More <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
        <div class="row my-2 pt-3">
            <div class="col-md-12">
            <h2 class="text-primary">Payment Services</h2>
            <hr>
            </div>
        </div>
        <div class="row">
            <hr>
            <div class="col-md-3 p-2 text-center">
                <img src="{{asset('images/ababank.png')}}"  alt="">
            </div>
            <div class="col-md-3 p-2 text-center">
                <img src="{{asset('images/chbank.png')}}"    alt="">
            </div>
            <div class="col-md-3 p-2 text-center">
                <img src="{{asset('images/sacombank.png')}}"  alt="">
            </div>
            <div class="col-md-3 p-2 text-center">
                <img src="{{asset('images/kbank.png')}}"  alt="">
            </div>
        </div>

        <!-- <div class="row my-5">
            <div class="col-md-12">
            <h2 class="text-success">Business Partners</h2>
            <hr>
            </div>
        </div>
        <div class="row">
            <hr>
            <div class="col-md-2 text-center" style="line-height: 100px;">
                <img src="{{asset('images/p4.png')}}" height="100" alt="">
            </div>
            <div class="col-md-2 text-center" style="line-height: 100px;">
                <img src="{{asset('images/p1.png')}}" height="100" alt="">
            </div>
            <div class="col-md-2 text-center" style="line-height: 100px;">
                <img src="{{asset('images/p2.png')}}"  height="100"  alt="">
            </div>
            <div class="col-md-2 text-center" style="line-height: 100px;">
                <img src="{{asset('images/p3.png')}}" height="100" alt="">
            </div>
            <div class="col-md-2 text-center" style="line-height: 100px;">
                <img src="{{asset('images/p5.png')}}" height="100" alt="">
            </div>
            <div class="col-md-2 text-center" style="line-height: 100px;">
                <img src="{{asset('images/p7.png')}}" height="100" alt="">
            </div>
        </div> -->
    </div> 


        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d250151.4521064407!2d104.75010230732494!3d11.57933057569886!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3109513dc76a6be3%3A0x9c010ee85ab525bb!2sPhnom+Penh!5e0!3m2!1sen!2skh!4v1540554478276" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>


    <!-- <div class="container-fluit content2">
        <div class="col-md-12 text-center">
            <h3>Enter the Future of Finance</h3>
            <p>Empowering individuals, investors, and developers to join the revolution</p>
            <a class="btn btn-outline-dark btn-white text-white flat" >Create Your Wallet</a>
            <a class="btn btn-outline-dark btn-learn text-white flat" >Learn More <i class="fa fa-arrow-right"></i></a>
        </div>
    </div> -->
@endsection