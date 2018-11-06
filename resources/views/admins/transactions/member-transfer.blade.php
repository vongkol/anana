@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <h3 class="page-header">
            <i class="fa fa-upload"></i> Member Transfer Transaction
        </h3>
       
        <table class="table table-condensed table-responsive">
            <thead>
                <tr>
                    <th>&numero;</th>
                    <th>From Username</th>
                    <th>To Username</th>
                    <th>Amount</th>
                    <th>Transfer Date</th>
                    <th>To Wallet</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $pagex = @$_GET['page'];
                    if(!$pagex)
                    $pagex = 1;
                    $i = 22 * ($pagex - 1) + 1;
                ?>
                @foreach($trans as $r)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$r->username}}</td>
                    <td>{{$r->account_name}}</td>
                    <td>$ {{$r->amount}}</td>
                    <td>{{$r->transaction_date}}</td>
                   
                    <td>{{$r->to_wallet}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{$trans->links()}}
    </div>
</div>
@endsection