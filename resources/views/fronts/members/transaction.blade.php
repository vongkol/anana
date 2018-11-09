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
                        <tr>
                            <td> <p></p>$ 1000</td>
                            <td> <p></p>WALLET DESCRIPTION</td>
                            <td> <p></p>2018-28-11</td>
                            <td> <p></p>
                                PENDING
                            </td>
                        </tr>
                       
                    </tbody>
                </table>
                </div>
            </div>
        </div><br>
       
        </div>
    </div>
</div>
@stop