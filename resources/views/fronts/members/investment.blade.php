@extends('layouts.page')
@section('content')
<div class="container" style="margin-top:150px">
        <h3>My Investment <a href="{{url('dashboard')}}" class="btn btn-success btn-sm">Back</a></h3>
        <p></p>
        <table class="table table-sm">
                <thead>
                        <tr>
                                <th>Investment Package</th>
                                <th>Invest Amount</th>
                                <th>Monthly Payout Rate</th>
                                <th>Day Of Contract</th>
                                <th>Invest Date</th>
                                <th>Expired On</th>
                        </tr>
                </thead>
                <tbody>
                        @if($investment!=null)
                                <tr>
                                        <td>{{$investment->name}}</td>
                                        <td>$ {{$investment->price}}</td>
                                        <td>{{$investment->monthly_payout}}%</td>
                                        <td>{{$investment->duration}}</td>
                                        <td>{{$investment->order_date}}</td>
                                        <td>{{$investment->expired_on}}</td>
                                </tr>
                        @endif
                </tbody>
        </table>
        @if($investment==null)
                <p class="text-center text-danger">You don't have an investment yet. <br>
                        <a href="{{url('member/investment/start')}}" class="btn btn-warning btn-sm">Start Investment Now</a>
                </p>
        @endif
</div>
@stop