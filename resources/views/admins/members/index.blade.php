@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <h3 class="page-header">
            <i class="fa fa-user"></i> Members 
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
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Country</th>
                    <th>Sponsor ID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $pagex = @$_GET['page'];
                    if(!$pagex)
                    $pagex = 1;
                    $i = 25 * ($pagex - 1) + 1;
                ?>
                @foreach($packages as $r)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$r->name}}</td>
                    <td>{{$r->price}} $</td>
                    <td>{{$r->monthly_payout}} %</td>
                    <td>{{$r->duration}}</td>
                    <td>
                        <a href="{{url('anana-admin/package/delete?id='.$r->id.'&page='.@$_GET['page'])}}" class="btn btn-danger btn-xs" 
                            title="Delete" onclick="return confirm('You want to delete?')">
                        <i class="fa fa-trash"></i></a>&nbsp;&nbsp;
                        <a href="{{url('anana-admin/package/edit/'.$r->id)}}" 
                            class="btn btn-success btn-xs" title="Edit"><i class="fa fa-pencil"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{$packages->links()}}
    </div>
</div>
@endsection