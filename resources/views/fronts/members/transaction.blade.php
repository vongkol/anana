@extends('layouts.page')
@section('content')
<div class="container">
    <div class="earning-dashboard">
        <h3>
        <span class="text-warning">TRANSACTIONS</span> &nbsp;
        <a href="{{url('dashboard')}}" class="btn btn-success btn-alc"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a>
        <hr class="hr-alc">
    </h3>
        <div class="row">
            <div class="col-sm-12">
            <div class="bg-light alc-box text-center  shadow-alc mb-5 border-radius-15">
                <h4 class="card-header">TRANSACTIONS HISTORY</h4>
                <div class="p-3">
                <table class="table table-sm table-bordered text-blue">
                    <thead>
                        <tr>
                            <th>AMOUNT</th>
                            <th>DESCRIPTION</th>
                            <th>DATE</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> <p></p>$ 1000</td>
                            <td> <p></p>WALLET DESCRIPTION</td>
                            <td> <p></p>2018-28-11</td>
                            <td> <p></p>
                                PENDING
                            </td>
                        </tr>
                        <tr>
                            <td>$ 1000</td>
                            <td>WALLET DESCRIPTION</td>
                            <td>2018-28-11</td>
                            <td>
                                PENDING
                            </td>
                        </tr>
                    </tbody>
                </table>
                </div>
            </div>
        </div><br>
        <!-- <div class="row">
            <div class="col-sm-12">
                <strong class="text-warning">WITHDRAWAL HISTORY</strong>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>DATE</th>
                            <th>AMOUNT</th>
                            <th>STATUS</th>
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
                <strong class="text-warning">TRANSFTER HISTORY</strong>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>DATE</th>
                            <th>AMOUNT</th>
                            <th>SENT</th>
                            <th>RECIEVED</th>
                            <th>DESCRIPTION</th>
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
        </div> -->
        </div>
    </div>
</div>
@stop