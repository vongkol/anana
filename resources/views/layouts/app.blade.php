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

    <!-- Custom Fonts -->
    <link href="{{asset('admin/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('admin/style.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

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
                <a class="navbar-brand" href="{{url('anana-admin')}}">
                    <img src="{{asset('admin/logo.png')}}" alt="Ana Lee Capital" width="40" style="display: inline"> <span>Ana Lee Capital </span>
                </a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                     
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
               
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> {{Auth::user()->name}} <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li class="user-photo">
                            <img src="{{asset('uploads/users/profiles/default.png')}}" alt="">
                        </li>
                        <li><a href="{{url('anana-admin/user/profile/'. Auth::user()->id)}}"><i class="fa fa-user fa-fw text-success"></i> My Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw text-warning"></i> Reset Password</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{{url('/anana-admin/logout')}}"><i class="fa fa-sign-out fa-fw text-danger"></i> Logout</a>
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
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="{{url('/anana-admin/dashboard')}}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="{{url('#')}}"><i class="fa fa-star fa-fw"></i> Payment Request</a>
                        </li>
                        <li>
                            <a href="{{url('#')}}"><i class="fa fa-star fa-fw"></i> Transaction</a>
                        </li>
                        <li>
                            <a href="{{url('#')}}"><i class="fa fa-star fa-fw"></i> Member Investment</a>
                        </li>
                        <li>
                            <a href="{{url('#')}}"><i class="fa fa-star fa-fw"></i> Member Sponsor</a>
                        </li>
                        <li>
                            <a href="{{url('anana-admin/member')}}"><i class="fa fa-user fa-fw"></i> Members</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-user fa-fw"></i> Withdrawal</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-dollar"></i> Admin Earnings<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">Earning</a>
                                </li>
                                <li>
                                    <a href="#">Admin Fee</a>
                                </li>
                                <li>
                                    <a href="#">Transfer Transactions</a>
                                </li>
                                <li>
                                    <a href="#">Earning Detail</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-cog text-success"></i> Settings<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{url('anana-admin/supply')}}"><i class="fa fa-ambulance"></i> Supply</a>
                                </li>
                                <li>
                                    <a href="{{url('anana-admin/block')}}"><i class="fa fa-cube"></i> Block</a>
                                </li>
                                <li>
                                    <a href="{{url('anana-admin/package')}}"><i class="fa fa-upload"></i> Package</a>
                                </li>
                                <li>
                                    <a href="{{url('anana-admin/exchange')}}"><i class="fa fa-dollar"></i> Exchange</a>
                                </li>
                                <li>
                                    <a href="{{url('#')}}"><i class="fa fa-dollar"></i> ANC Rate</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-key text-danger"></i> Security<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{url('anana-admin/role')}}"><i class="fa fa-shield"></i> User Roles</a>
                                </li>
                                <li>
                                    <a href="{{url('anana-admin/user')}}"><i class="fa fa-users"></i> Users</a>
                                </li>
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
    <script src="{{asset('admin/vendor/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('admin/vendor/morrisjs/morris.min.js')}}"></script>
    <script src="{{asset('admin/data/morris-data.js')}}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{asset('admin/dist/js/sb-admin-2.js')}}"></script>
    @yield('js')

</body>

</html>