@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <h3 class="page-header">
            <i class="fa fa-cube"></i> Block 
            @insert('Block')
            <a href="{{url('analee-admin/block/create')}}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> New</a>
            @endinsert
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
                    <th>Block Title</th>
                    <th>Total Token</th>
                    <th>Balance</th>
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
                @foreach($blocks as $r)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$r->title}}</td>
                    <td>{{$r->total_token}}</td>
                    <td>{{$r->balance}}</td>
                    <td>
                        @delete('Block')
                        <a href="{{url('analee-admin/block/delete?id='.$r->id.'&page='.@$_GET['page'])}}" class="btn btn-danger btn-xs" 
                            title="Delete" onclick="return confirm('You want to delete?')">
                        <i class="fa fa-trash"></i></a>&nbsp;&nbsp;
                        @enddelete
                        @update('Block')
                        <a href="{{url('analee-admin/block/edit/'.$r->id)}}" 
                            class="btn btn-success btn-xs" title="Edit"><i class="fa fa-pencil"></i></a>
                        @endupdate
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{$blocks->links()}}
    </div>
</div>
@endsection