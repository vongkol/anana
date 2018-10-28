@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <h3 class="page-header">
            <i class="fa fa-ambulance"></i> Supply
        </h3>
        @if(Session::has('sms'))
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div>
                    {{session('sms')}}
                </div>
            </div>
        @endif
        <table class="table table-condensed table-responsive">
            <thead>
                <tr>
                    <th>&numero;</th>
                    <th>Title</th>
                    <th>Total E-share</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $pagex = @$_GET['page'];
                    if(!$pagex)
                    $pagex = 1;
                    $i = 18 * ($pagex - 1) + 1;
                ?>
                @foreach($supplies as $r)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$r->title}}</td>
                    <td>{{$r->total_token}}</td>
                    <td>
                        <a href="{{url('analee-admin/supply/edit/'.$r->id)}}" 
                            class="btn btn-success btn-xs" title="Edit"><i class="fa fa-pencil"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{$supplies->links()}}
    </div>
</div>
@endsection