@extends('layouts.page')
@section('content')
<link rel="stylesheet" href="{{asset('tree/Treant.css')}}">
<link rel="stylesheet" href="{{asset('tree/examples/basic-example/basic-example.css')}}">
<div class="container">
    <div class="earning-dashboard">
        <h3>
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


    // grand pa node
    var papa = {
         text: {
            name: "{{$m->username}}"
               
        },
        image: "{{asset('images/icon.png')}}"
    };
    // initial config
    chart_config = [
        config,
        papa
    ];

    // first gen 1 node
    <?php
        $gen1 = DB::table('members')->where('sponsor_id', $m->username)->get();
    ?>
    @foreach($gen1 as $g1)
        var gen1 = {
           parent: papa,
           text: {
                name: "{{$g1->username}}"
           },
           image: "{{asset('images/icon.png')}}"
        };
        // push the gen1 to array
        chart_config.push(gen1);
        // find the gen2
        <?php $gen2 = DB::table('members')->where('sponsor_id', $g1->username)->get(); ?>
        @foreach($gen2 as $g2)
            var gen2 = {
                parent: gen1,
                text: {
                    name: "{{$g2->username}}"
                },
                image: "{{asset('images/icon.png')}}"
            };
            chart_config.push(gen2);
            // find the gen3
            <?php $gen3 = DB::table('members')->where('sponsor_id', $g2->username)->get(); ?>
            @foreach($gen3 as $g3)
                var gen3 = {
                    parent: gen2,
                    text: {
                        name: "{{$g3->username}}"
                    },
                    image: "{{asset('images/icon.png')}}"
                };
                chart_config.push(gen3);
                // find the gen4
                <?php $gen4 = DB::table('members')->where('sponsor_id', $g3->username)->get(); ?>
                @foreach($gen4 as $g4)
                    var gen4 = {
                        parent: gen3,
                        text: {
                            name: "{{$g4->username}}"
                        },
                        image: "{{asset('images/icon.png')}}"
                    };
                    chart_config.push(gen4);
                    // find the gen 5
                    <?php $gen5 = DB::table('members')->where('sponsor_id', $g4->username)->get(); ?>
                    @foreach($gen5 as $g5)
                        var gen5 = {
                            parent: gen4,
                            text: {
                                name: "{{$g5->username}}"
                            },
                            image: "{{asset('images/icon.png')}}"
                        };
                        chart_config.push(gen5);
                        // find the gen 6
                        <?php $gen6 = DB::table('members')->where('sponsor_id', $g5->username)->get(); ?>
                        @foreach($gen6 as $g6)
                            var gen6 = {
                                parent: gen5,
                                text: {
                                    name: "{{$g6->username}}"
                                },
                                image: "{{asset('images/icon.png')}}"
                            };
                            chart_config.push(gen6);
                         
                            
                        @endforeach
                    @endforeach
                @endforeach
            @endforeach
        @endforeach
    @endforeach

        new Treant( chart_config );
    </script>
@stop