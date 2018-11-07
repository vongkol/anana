@extends('layouts.page')
@section('content')
<div class="container">
    <div class="container-page">
        <nav aria-label="breadcrumb">
            
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Investment Package</li>
            </ol>
            <h4 class="pull-right page-title mb-title text-warning">
                INVESTMENT PACKAGE
            </h4>
        </nav>
    </div>
</div>
<div class="bg-investment">
<div class="container">
    <div class="pricing row">
    @foreach($packages as $p)
        <div class="col-md-3 my-2 px-2 ">
            <div class="card card-pricing shadow text-center">
                <span class="h6 w-60 investment-name mx-auto px-4 py-2  rounded-bottom bg-warning text-dark shadow-sm"><strong><i class="fa fa-diamond" aria-hidden="true"></i> {{$p->name}}</strong></span>
                <div class="bg-transparent card-header px-1 border-0">
                    <h1 class="h1 font-weight-normal text-danger text-center mb-0" data-pricing-value="15">$<span class="price">{{$p->price}}</span><span class="h6 text-dark ml-2">/ {{$p->duration}} days</span></h1>
                </div>
                <div class="card-body pt-0">
                    <ul class="list-unstyled mb-4">
                        <h5>Payout: {{$p->monthly_payout}}%</h5>
                    </ul>
                    <button type="button" class="btn btn-dark shadow rounded btn-blog mb-3"><img src="{{asset('images/invesment.png')}}" alt="" width="30"> <strong> Invest Now</strong></button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    </div>
</div>
@endsection