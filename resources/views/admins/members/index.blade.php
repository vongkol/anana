@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <h3 class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <i class="fa fa-user"></i> Members 
                </div>
                <div class="col-sm-6">
                    <form action="#">
                        <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                    </form>
                </div>
            </div>
            
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
                @foreach($members as $m)
                <tr>
                    <td>{{$i++}}</td>
                    <td>
                        <a href="{{url('anana-admin/member/detail/'.$m->id)}}" class="text-primary">{{$m->full_name}}</a>    
                    </td>
                    <td>{{$m->username}}</td>
                    <td>{{$m->email}}</td>
                    <td>{{$m->phone}}</td>
                    <td>{{$m->country}}</td>
                    <td>{{$m->sponsor_id}}</td>
                    <td>
                        <a href="{{url('anana-admin/member/detail/'.$m->id)}}" 
                                class="btn btn-success btn-xs" title="View"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;
                        <a href="{{url('anana-admin/member/delete/'.$m->id.'&page='.@$_GET['page'])}}" class="btn btn-danger btn-xs" 
                            title="Delete" onclick="return confirm('You want to delete?')">
                        <i class="fa fa-trash"></i></a>
                       
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <p>
            Total Members: {{$total}}
        </p>
        {{$members->links()}}
    </div>
</div>
@endsection