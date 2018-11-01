@extends('layouts.front')
@section('content')
<div class="container">
    <div class="container-page">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Contact</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container-fluit page-background-color">
    <div class="container container-c text-center">
        <div class="main-container-page">
            <h5 class="sub-title-image">CONTACT US</h5>
            <div class="row my-5">
               <div class="col-md-6 text-left">
               <aside> #A3, St.BT, Sangkat Chomchaov, Khan Porsenchey, Phnom Penh, Kindom of Cambodia</aside>
                <aside class="col-md-12">
                    <div class="row">
                        <div>
                            Email:
                        </div>
                        <div class="px-2">
                            support@analeecapital.com <br>
                            sales@analeecapital.com
                        </div>
                    </div>
                </aside>
               </div>
               <div class="col-md-6">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2324.365329848776!2d104.8313730408903!3d11.54461593369993!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31094fd553400b85%3A0xd5336e32f60085ec!2sPhnom+Penh+International+Airport!5e0!3m2!1sen!2skh!4v1541086372842" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
               </div>
            </div>
        </div>
    </div>
</div>
@stop