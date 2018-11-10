@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <h3 class="page-header">
            <i class="fa fa-upload"></i> Credit Transaction
        </h3>
       
        <table class="table table-condensed table-responsive">
            <thead>
                <tr>
                    <th>&numero;</th>
                    <th>By User</th>
                    <th>To Account</th>
                    <th>Amount</th>
                    <th>Transfer Date</th>
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
                    <td>{{$r->from_username}}</td>
                    <td>{{$r->to_username}}</td>
                    <td>$ {{$r->amount}}</td>
                    <td>{{$r->transfer_date}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{$trans->links()}}
    </div>
</div>
@endsection