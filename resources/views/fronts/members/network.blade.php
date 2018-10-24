@extends('layouts.page')
@section('content')
<link rel="stylesheet" href="{{asset('tree/Treant.css')}}">
<link rel="stylesheet" href="{{asset('tree/examples/basic-example/basic-example.css')}}">
<div class="container">
    <div class="earning-dashboard">
        <h3 style="font-size: 25px;">
            <img src="{{asset('images/mynetwork.png')}}" alt="" width="50"> 
            &nbsp; <strong >My Network </strong>  &nbsp;
            <a href="{{url('dashboard')}}" class="btn btn-success btn-sm"> <i class="fa fa-arrow-left"></i>  Back</a>
        </h3>
        <p></p>
        <div class="row">
            <div class="col-sm-12">
                <div class="chart" id="tree"></div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('tree/vendor/raphael.js')}}"></script>
    <script src="{{asset('tree/Treant.js')}}"></script>
    
    <script>

        var config = {
            container: "#tree",
            
            connectors: {
                type: 'step'
            },
            node: {
                HTMLclass: 'nodeExample1'
            }
        };


        var ceo = {
            text: {
                name: "Vongkol",
                title: "",
                contact: "",
            },
            image: "/images/icon.png"
        };

    var cto = {
        parent: ceo,
        text:{
            name: "Oudom",
            title: "",
        },
        stackChildren: true,
        image: "/images/icon.png"
    };

    var cbo = {
        parent: ceo,
        stackChildren: true,
        text:{
            name: "Linda May",
            title: "Chief Business Officer",
        },
        image: "../headshots/5.jpg"
    },
    cdo = {
        parent: ceo,
        text:{
            name: "John Green",
            title: "Chief accounting officer",
            contact: "Tel: 01 213 123 134",
        },
        image: "../headshots/6.jpg"
    };
    
    var cio = {
        parent: cto,
        text:{
            name: "Ron Blomquist",
            title: "Chief Information Security Officer"
        },
        image: "../headshots/8.jpg"
    };
    var ciso = {
        parent: cto,
        text:{
            name: "Michael Rubin",
            title: "Chief Innovation Officer",
            contact: {val: "we@aregreat.com", href: "mailto:we@aregreat.com"}
        },
        image: "../headshots/9.jpg"
    };
    var cio2 = {
        parent: cdo,
        text:{
            name: "Erica Reel",
            title: "Chief Customer Officer"
        },
        image: "../headshots/10.jpg"
    };
    var ciso2 = {
        parent: cbo,
        text:{
            name: "Alice Lopez",
            title: "Chief Communications Officer"
        },
        image: "../headshots/7.jpg"
    };
    var ciso3 = {
        parent: cbo,
        text:{
            name: "Mary Johnson",
            title: "Chief Brand Officer"
        },
        image: "../headshots/4.jpg"
    };
    var ciso4 = {
        parent: cbo,
        text:{
            name: "Kirk Douglas",
            title: "Chief Business Development Officer"
        },
        image: "../headshots/11.jpg"
    };

    chart_config = [
        config,
        ceo,
        cto,
       
    ];
        new Treant( chart_config );
    </script>
@stop