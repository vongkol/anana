@extends('layouts.page')
@section('content')
<div class="container">
    <div class="earning-dashboard">
        <h3>
        <span class="text-warning">TRANSACTIONS</span> &nbsp;
        <a href="{{url('dashboard')}}" class="btn btn-success btn-alc"><i class="fa fa-arrow-left" aria-hidden="true"></i>  Back</a>
        <hr class="hr-alc">
    </h3>
        <div class="row">
            <div class="col-sm-12">
            <div class="bg-light alc-box text-center  shadow-alc mb-5 border-radius-15">
                <h4 class="card-header">TRANSACTIONS HISTORY</h4>
                <div class="p-3">
                <table class="table table-sm table-bordered text-blue">
                    <thead>
                        <tr>
                            <th>AMOUNT</th>
                            <th>DESCRIPTION</th>
                            <th>DATE</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach($trans as $t)
                            <tr>
                                <td> <p></p>$ {{$t->amount}}</td>
                                <td> <p></p>{{$t->description}}</td>
                                <td> <p></p>{{date_format(date_create($t->create_at), 'Y-m-d')}}</td>
                                <td> <p></p>
                                @if($t->status==1)
                                    Completed
                                @else
                                    Pending
                                @endif
                                </td> 
                            </tr>
                       @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div><br>
       
        </div>
    </div>
</div>
@stop