@extends('layouts.front')
@section('content')
   <header class="masthead">
        <div class="container">
            <div class="row">
            <div class="col-md-12">
                <div class="site-heading">
                <h1 class="text-warning">Connecting the world to Crypto</h1>
                <span class="subheading">The easy way to send, receive, store, and trade digital currencies</span><br>
                <a class="btn btn-outline-dark btn-white flat" >Create Your Wallet</a>
                </div>
            </div>
        </div>
    </header>
    <div class="container-fluit set">
        <section class="container text-center font-weight-bold">
            <div class="row">
                <div class="col-md-3">
                    <span>25M+</span><br><span>Wallets</span>
                </div>
                <div class="col-md-3">
                    <span>$200B+</span><br><span>Transacted</span>
                </div>
                <div class="col-md-3">
                    <span>140</span><br><span>Countries</span>
                </div>
                <div class="col-md-3">
                    <span>2018</span><br><span>Founded</span>
                </div>
            </div>
        </section>
    </div>
    <div class="container my4 container-c">
        <div class="row">
            <div class="col-lg-5 col-md-5" >
                <div class="post-preview">
                    <a href="post.html">
                    <h2 class="post-title">
                        Your Passport to the Future of Finance
                    </h2>
                    <h4 class="post-subtitle">
                        The first and most trusted global cryptocurrency company
                    </h4>
                    </a>
                </div>
            </div>
            <div class="col-md-7">
                <img src="{{asset('fronts/img/home.png')}}" width="100%">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="content3">
                    <h5>Invest</h5>
                    <p>Exchange and transact bitcoin, ethereum, and bitcoin cash using the world’s most trusted and secure cryptocurrency wallet</p>
                    <a href=""> Learn More <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="content3">
                    <h5>Explore</h5>
                    <p>Use the first and most popular bitcoin block explorer to search and verify transactions on Bitcoin’s blockchain.</p>
                    <a href=""> Learn More <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="content3">
                    <h5>Analyze</h5>
                    <p>Stay on top of bitcoin and other top cryptocurrency prices, news, and market information.</p>
                    <a href=""> Learn More <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
        <div class="row my-5">
            <div class="col-md-4">
                <p>
                    <img src="{{asset('fronts/img/promotion.jpg')}}" width="100%" alt="">
                </p>
                <div class="content3">
                    <h5>Promotion Sale</h5>
                    <p>Stay on top of bitcoin and other top cryptocurrency prices, news, and market information.</p>
                    <a href="" class=""> Read More <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-md-4">
                <p>
                    <img src="{{asset('fronts/img/promotion3.jpg')}}" width="100%" alt="">
                </p>
                <div class="content3">
                    <h5>Promotion Sale</h5>
                    <p>Stay on top of bitcoin and other top cryptocurrency prices, news, and market information.</p>
                    <a href="" class=""> Read More <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="col-md-4">
                <p>
                    <img src="{{asset('fronts/img/promotion2.jpg')}}" width="100%" alt="">
                </p>
                <div class="content3">
                    <h5>Promotion Sale</h5>
                    <p>Stay on top of bitcoin and other top cryptocurrency prices, news, and market information.</p>
                    <a href="" class=""> Read More <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluit content2">
        <div class="col-md-12 text-center">
            <h3 class="text-white">Enter the Future of Finance</h3>
            <p class="text-white">Empowering individuals, investors, and developers to join the revolution</p>
            <a class="btn btn-outline-dark btn-white text-white  flat" >Create Your Wallet</a>
            <a class="btn btn-outline-primary btn-learn text-white flat" >Learn More <i class="fa fa-arrow-right"></i></a>
        </div>
    </div>
@endsection