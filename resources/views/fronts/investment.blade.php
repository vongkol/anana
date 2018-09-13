@extends('layouts.page')
@section('content')

<div class="container-fluit set">
    <section class="container text-center">
       <h1>Investment Plans</h1>
    </section>
</div>
<div class="container my-5">
    <div class="pricing card-deck ">
    @foreach($packages as $p)
        <div class="card card-pricing shadow text-center col-md-3">
            <span class="h6 w-60 mx-auto px-4 py-1 rounded-bottom bg-warning text-white shadow-sm">{{$p->name}}</span>
            <div class="bg-transparent card-header pt-4 border-0">
                <h1 class="h1 font-weight-normal text-warning text-center mb-0" data-pricing-value="15">$<span class="price">{{$p->price}}</span><span class="h6 text-muted ml-2">/ {{$p->duration}} days</span></h1>
            </div>
            <div class="card-body pt-0">
                <ul class="list-unstyled mb-4">
                    <h5>Payout: {{$p->monthly_payout}}%</h5>
                </ul>
                <button type="button" class="btn btn-outline-warning btn-blog rounded-0 mb-3">Order now</button>
            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection