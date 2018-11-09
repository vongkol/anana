@extends('layouts.front')
@section('content')
<div class="container">
    <div class="container-page">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">White Paper</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container-fluit page-white-paper">
    <div class="container text-center">
    <div class="bg-light  font-weight-bold shadow-alc p-3 border-radius-15"><br>
        <div class="main-container-page">
            <h5 class="sub-title-image">WHITE PAPER</h5>
            <div class="description">
                <p>
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators carousel-indicators-c">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="6"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="7"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="8"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="9"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="10"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="11"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="12"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="12"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="13"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="14"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="15"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="16"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="17"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="18"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="{{asset('images/white-paper/1.png')}}" alt="">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{asset('images/white-paper/2.png')}}" alt="">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{asset('images/white-paper/3.png')}}" alt="">
                        </div>
                        <div class="carousel-item ">
                            <img class="d-block w-100" src="{{asset('images/white-paper/4.png')}}" alt="">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{asset('images/white-paper/5.png')}}" alt="">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{asset('images/white-paper/6.png')}}" alt="">
                        </div>
                        <div class="carousel-item ">
                            <img class="d-block w-100" src="{{asset('images/white-paper/7.png')}}" alt="">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{asset('images/white-paper/8.png')}}" alt="">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{asset('images/white-paper/9.png')}}" alt="">
                        </div>
                        <div class="carousel-item ">
                            <img class="d-block w-100" src="{{asset('images/white-paper/10.png')}}" alt="">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{asset('images/white-paper/11.png')}}" alt="">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{asset('images/white-paper/12.png')}}" alt="">
                        </div>
                        <div class="carousel-item ">
                            <img class="d-block w-100" src="{{asset('images/white-paper/13.png')}}" alt="">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{asset('images/white-paper/14.png')}}" alt="">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{asset('images/white-paper/15.png')}}" alt="">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{asset('images/white-paper/16.png')}}" alt="">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{asset('images/white-paper/17.png')}}" alt="">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{asset('images/white-paper/18.png')}}" alt="">
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
                </p>
            </div>
        </div></div>
    </div>
</div>
@stop