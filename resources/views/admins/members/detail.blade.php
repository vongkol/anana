@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <h3 class="page-header">
            <div class="row">
                <div class="col-sm-5">
                    <i class="fa fa-user"></i> Member Detail 
                    <a href="{{url('anana-admin/member')}}" class="btn btn-success btn-xs"><i class="fa fa-arrow-left"></i> Back</a>
                </div>
                <div class="col-sm-7">
                    <form action="#">
                        <input type="text" placeholder="search...">
                        <button>Search</button>
                    </form>
                </div>
            </div>
            
        </h3>
    </div>
</div>
<div class="row">
    <div class="col-sm-5">
       <h4>Profile Detail</h4>
        <table class="table table-sm">
            <tr>
                <td>Sponsor ID</td>
                <th>: {{$member->sponsor_id}}</th>
            </tr>
            <tr>
                <td>Full Name</td>
                <th>: {{$member->full_name}}</th>
            </tr>
            <tr>
                <td>Username</td>
                <th>: {{$member->username}}</th>
            </tr>
            <tr>
                <td>Email</td>
                <th>: {{$member->email}}</th>
            </tr>
            <tr>
                <td>Phone</td>
                <th>: {{$member->phone}}</th>
            </tr>
            <tr>
                <td>Country</td>
                <th>: {{$member->country}}</th>
            </tr>
            <tr>
                <td colspan="2">
                    <a href="#" class="btn btn-sm btn-primary">Reset Password</a>
                    <a href="#" class="btn btn-sm btn-warning">Reset Security Pin</a>
                    <a href="#" class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>
        </table>
       
    </div>
    <div class="col-sm-1"></div>
    <div class="col-sm-4">
        <h4>Actions</h4>
        <table class="table table-sm">
            <tr>
                <td>
                    
                </td>
            </tr>
            <tr>
                <td>
                    
                </td>
            </tr>
            <tr>
                <td>
                    
                </td>
            </tr>
        </table>
    </div>
</div>
@endsection