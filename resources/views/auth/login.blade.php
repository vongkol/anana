<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="sorvichey">
    <title>User Login</title>
    <link href="{{asset('admin/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/vendor/metisMenu/metisMenu.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/dist/css/sb-admin-2.css')}}" rel="stylesheet">
    <link href="{{asset('admin/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
</head>
<body style="background: #232321;">
        <div class="container" style="margin-top: 100px;">
            <div class="row">
            <h1 style="color: #f9ad19;" class="text-center">
            
                <img src="{{asset('images/alc-logo.png')}}" alt=""></h1>
                <div class="col-md-4 col-md-offset-4">
               
                    <div class="panel panel-default">
                        <div class="panel-heading">User Login</div>
        
                        <div class="panel-body">
                            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}
                                <p></p>
                                <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
                                   
        
                                    <div class="col-md-12">
                                    <label for="email">E-Mail Address</label>
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
        
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
        
                                <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
                                   
        
                                    <div class="col-md-12">
                                        <label for="password">Password</label>
                                        <input id="password" type="password" class="form-control" name="password" required>
        
                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="group-form">
                                    <div class="col-md-12 " style="padding-top: 15px;">
                                        <button type="submit" class="form-control btn btn-success">
                                            Login
                                        </button>
                                    </div>
                                </div>
                                <p></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- jQuery -->
    <script src="{{asset('admin/vendor/jquery/jquery.min.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('admin/vendor/bootstrap/js/bootstrap.min.js')}}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{asset('admin/vendor/metisMenu/metisMenu.min.js')}}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{asset('admin/dist/js/sb-admin-2.js')}}"></script>
</body>
</html>
