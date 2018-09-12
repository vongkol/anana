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
       <h2>Investment Plans</h2>
    </section>
</div>
<div class="container">
    <p>&nbsp;</p>
    <div class="row">
        @foreach($packages as $p)
            <div class="col-sm-3">
                <h4>{{$p->name}}</h4>
                <hr>
                <div>Price: {{$p->price}}$</div>
                <div>Payout: {{$p->monthly_payout}}%</div>
                <div>Duration: {{$p->duration}} days</div>
                <div>
                    <button class="btn btn-primary btn-sm">Buy Now</button>
                </div>
                <p>&nbsp;</p>
            </div>
        @endforeach
    </div>
    <hr>
</div>
@endsection