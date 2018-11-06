@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <h3 class="page-header">
            <i class="fa fa-upload"></i> Payment Request 
        </h3>
       
        <table class="table table-condensed table-responsive">
            <thead>
                <tr>
                    <th>&numero;</th>
                    <th>Account Name</th>
                    <th>Email</th>
                    <th>Request Amount</th>
                    <th>Request Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $pagex = @$_GET['page'];
                    if(!$pagex)
                    $pagex = 1;
                    $i = 22 * ($pagex - 1) + 1;
                ?>
                @foreach($payments as $r)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$r->username}}</td>
                    <td>{{$r->email}}</td>
                    <td>$ {{$r->amount}}</td>
                    <td>{{$r->request_date}}</td>
                    <td>
                        @if($r->status==1)
                            Approved
                        @else
                            Pending
                        @endif
                    </td>
                    <td>
                        @if($r->status==0)
                            <a href="{{url('analee-admin/member/payment/approve')}}" class="btn btn-success btn-xs" 
                            title="Approve" onclick="return confirm('You want to approve this?')">
                                Approve
                            </a>
                       
                        @endif
                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{$payments->links()}}
    </div>
</div>
@endsection