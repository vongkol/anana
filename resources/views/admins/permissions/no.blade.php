@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <h3 class="page-header">
            <i class="fa fa-key"></i> Warning!
            <a href="{{url('analee-admin/role')}}" class="btn btn-success btn-xs"><i class="fa fa-arrow-left"></i> Back</a>
        </h3>
       <p>&nbsp;</p>
       <h4 class="text-danger text-center">You have permission to access this page. Please contact the administrator!</h4>
    </div>
</div>
@endsection