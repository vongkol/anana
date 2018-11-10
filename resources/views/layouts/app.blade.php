<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ana Lee Capital | Admin</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{asset('admin/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{asset('admin/vendor/metisMenu/metisMenu.min.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{asset('admin/dist/css/sb-admin-2.css')}}" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="{{asset('admin/vendor/morrisjs/morris.css')}}" rel="stylesheet">
    <link href="{{asset('admin/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('admin/style.css')}}">
    <link rel="stylesheet" href="{{asset('admin/custom.css')}}">
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{url('analee-admin')}}">
                    <img src="{{asset('admin/logo.png')}}" alt="Ana Lee Capital" width="40" style="display: inline"> <span>Ana Lee Capital </span>
                </a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> {{Auth::user()->name}} <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li class="user-photo">
                            <img src="{{asset('uploads/users/profiles/default.png')}}" alt="">
                        </li>
                        <li><a href="{{url('analee-admin/user/profile/'. Auth::user()->id)}}">
                            <i class="fa fa-user fa-fw text-success"></i> My Profile</a>
                        </li>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{{url('/analee-admin/logout')}}"><i class="fa fa-sign-out fa-fw text-danger"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                       @view('Dashboard')
                        <li>
                            <a href="{{url('/analee-admin/dashboard')}}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        @endview
                        @view('Total Earning')
                        <li>
                            <a href="{{url('analee-admin/earning')}}"> <i class="fa fa-arrow-right"></i> Total Earning</a>
                        </li>
                        @endview
                        <li>
                            <a href="{{url('analee-admin/member/payment')}}"><i class="fa fa-star fa-fw"></i> Payment Request</a>
                        </li>
                        @view('Member')
                        <li>
                            <a href="{{url('analee-admin/member')}}"><i class="fa fa-user fa-fw"></i> Members</a>
                        </li>
                        @endview
                        @view('Credit Transaction')
                        <li>
                            <a href="{{url('analee-admin/member/fill-credit')}}">
                                <i class="fa fa-star fa-fw"></i> Credit Transaction</a>
                        </li>
                        @endview
                        <li>
                            <a href="{{url('analee-admin/member/transaction')}}">
                                <i class="fa fa-arrow-right"></i> Member Earning Transaction 
                            </a>
                        </li>
                        <li>
                            <a href="{{url('analee-admin/member/transfer')}}">
                                <i class="fa fa-arrow-right"></i> Member Transfer Transaction 
                            </a>
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-cog text-success"></i> Settings<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                @view('Supply')
                                <li>
                                    <a href="{{url('analee-admin/supply')}}"><i class="fa fa-ambulance"></i> Supply</a>
                                </li>
                                @endview
                                @view('Block')
                                <li>
                                    <a href="{{url('analee-admin/block')}}"><i class="fa fa-cube"></i> Block</a>
                                </li>
                                @endview
                                @view('Package')
                                <li>
                                    <a href="{{url('analee-admin/package')}}"><i class="fa fa-upload"></i> Package</a>
                                </li>
                                @endview
                                @view('Exchange')
                                <li>
                                    <a href="{{url('analee-admin/exchange')}}"><i class="fa fa-dollar"></i> Exchange</a>
                                </li>
                                @endview
                                <li>
                                    <a href="{{url('#')}}"><i class="fa fa-dollar"></i> ALC Rate</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-key text-danger"></i> Security<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                @view('Role')
                                <li>
                                    <a href="{{url('analee-admin/role')}}"><i class="fa fa-shield"></i> Roles</a>
                                </li>
                                @endview
                                @view('User')
                                <li>
                                    <a href="{{url('analee-admin/user')}}"><i class="fa fa-users"></i> Users</a>
                                </li>
                                @endview
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            @yield('content')
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <p></p>
                Copy&copy; {{date('Y')}} by Anana Capital.
                <p></p>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="{{asset('admin/vendor/jquery/jquery.min.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('admin/vendor/bootstrap/js/bootstrap.min.js')}}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{asset('admin/vendor/metisMenu/metisMenu.min.js')}}"></script>

    <!-- Morris Charts JavaScript -->
    <!-- <script src="{{asset('admin/vendor/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('admin/vendor/morrisjs/morris.min.js')}}"></script>
    <script src="{{asset('admin/data/morris-data.js')}}"></script> -->

    <!-- Custom Theme JavaScript -->
    <script src="{{asset('admin/dist/js/sb-admin-2.js')}}"></script>
    <script>
        var burl = "{{url('/')}}";
    </script>
    @yield('js')

</body>

</html>