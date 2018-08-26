@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <h3 class="page-header">
            <i class="fa fa-key"></i> Role 
            <a href="#" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> New</a>
        </h3>
        <table class="table table-condensed table-responsive">
            <thead>
                <tr>
                    <th>&numero;</th>
                    <th>Role Name</th>
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
                @foreach($roles as $r)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$r->name}}</td>
                    <td>
                        <a href="#" class="btn btn-danger btn-xs" title="Delete" onclick="return confirm('You want to delete?')"><i class="fa fa-trash"></i></a>&nbsp;&nbsp;
                        <a href="#" class="btn btn-success btn-xs" title="Edit"><i class="fa fa-pencil"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection