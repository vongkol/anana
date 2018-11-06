@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <h3 class="page-header">
            <i class="fa fa-arrow-right"></i> Ana Lee Earning
        </h3>
        <strong>Total Earnings: $ {{$amount->earning}}</strong>
    </div>
</div>
@endsection