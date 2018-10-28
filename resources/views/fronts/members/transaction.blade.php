@extends('layouts.page')
@section('content')
<div class="container">
    <div class="earning-dashboard">
        <h3>
            <img src="{{asset('images/transactions.png')}}" width="55" alt="">
        My Transaction <a href="{{url('dashboard')}}" class="btn btn-success btn-sm"> <i class="fa fa-arrow-left"></i>   <i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a></h3>
        <p></p>
        <div class="row">
            <div class="col-sm-12">
                <strong class="text-primary">Withdrawal History</strong>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $p)
                            <tr>
                                <td>{{$p->id}}</td>
                                <td>{{$p->request_date}}</td>
                                <td>{{$p->amount}} $</td>
                                <td>
                                    @if($p->status==0)
                                        pending
                                    @else
                                        approved
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        
        </div>
        <p></p>
        <div class="row">
            <div class="col-sm-12">
                <strong class="text-danger">Transfer History</strong>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Send To</th>
                            <th>Send From</th>
                            <th>Note</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($trans as $t)
                            <tr>
                                <td>{{$t->id}}</td>
                                <td>{{$t->transaction_date}}</td>
                                <td>{{$t->amount}} $</td>
                                <td>{{$t->account_name}}</td>
                                <td></td>
                                <td>{{$t->note}}</td>
                            </tr>
                        @endforeach
                        @foreach($trans1 as $t)
                            <tr>
                                <td>{{$t->id}}</td>
                                <td>{{$t->transaction_date}}</td>
                                <td>{{$t->amount}} $</td>
                                <td></td>
                                <td>{{$t->account_name}}</td>
                                <td>{{$t->note}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop