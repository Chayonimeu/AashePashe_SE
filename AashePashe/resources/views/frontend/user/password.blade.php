<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>AashePashe | Change Password</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap_min.css')}}" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{asset('frontend/assets/css/ion_icon.css')}}" />
        <link rel="stylesheet" href="{{asset('frontend/assets/css/template_main.css')}}" />
        <link rel="stylesheet" href="{{asset('frontend/assets/css/template_all_skin.css')}}" />
        <link rel="stylesheet" href="{{asset('frontend/assets/css/custom_style.css')}}" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition skin-blue layout-top-nav">
        <div class="container">
            <div class="row" style="height: 30px;margin-top: 10px">
                <div class="col-md-12" style="">
                    <div class="col-md-6">
                        <span style="font-size: 16px"><i class="fa fa-map-marker "></i> Dhaka</span>
                        <a href="javascript:void(0)" style="font-size: 10px;border: 1px solid #ecf0f5;padding: 3px;border-radius: 5px">Switch City</a>
                    </div>
                    <div class="col-md-6 hidden-sm hidden-xs text-right">
                        <ul class="social-network social-circle">
                            <li><a href="#" class="icoRss" title="Rss"><i class="fa fa-rss"></i></a></li>
                            <li><a href="#" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#" class="icoTwitter" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#" class="icoGoogle" title="Google +"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#" class="icoLinkedin" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="wrapper">
            <header class="main-header">
                <nav class="navbar navbar-static-top">
                    <div class="container">
                        <div class="navbar-header">
                            <a href="" class="navbar-brand"><img class="img img-responsive" src="{{ asset('frontend/images/logo.png') }}" /></a>
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                                <i class="fa fa-bars"></i>
                            </button>
                        </div>
                    </div>
                </nav>
            </header>
            <div class="content-wrapper">
                <div class="container">
                    <div class="row" style="margin-top: 20px">
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <div class="box box-primary">
                                    <div class="box-body box-profile">
                                        <img src="{{ asset('frontend/images/default.jpg') }}" class="profile-user-img img-responsive img-circle" alt="Image">
                                        <center>
                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#avatar1" style="font-size: 10px"><i class="fa fa-image"></i> Change Avatar</a>
                                            @php $last_login = App\SessionActivityModel::where('user_id', Auth::user()->user_id)->where('user_type', 'User')->first(); @endphp
                                            <br><small>Last Login {{ $last_login->last_login }}</small>
                                        </center>
                                        <div class="profile-usermenu">
                                            <ul class="nav">
                                                <li><a href="{{ URL::to('dashboard') }}"><i class="fa fa-user"></i> Account Information</a></li>
                                                <li class="active"><a href="{{ URL::to('change/password') }}"><i class="fa fa-lock"></i> Change Password</a></li>
                                                <li><a href="#"><i class="fa fa-cart-plus"></i>Order History</a></li>
                                                <li><a href="#"><i class="fa fa-heart"></i>Favourites</a></li>
                                            </ul>
                                        </div>                                    
                                        <a href="{{ URL::to('logout') }}" class="btn btn-primary btn-block btn-xs"><b><i class="fa fa-sign-out"></i> Sign Out</b></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="box box-primary" style="min-height: 370px">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">Change Password</div>
                                        <div class="panel-body">
                                            @include('frontend.layout.message')
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <form action="{{ URL::to('/update/password') }}" method="POST">
                                                        {{ csrf_field() }}
                                                        <div class="form-group has-feedback">
                                                            <label for="password">Current Password <b style="color: red">*</b></label>
                                                            <input type="password" class="form-control" id="password" name="password" value="" required="required" placeholder="Enter Current Password">
                                                            @if ($errors->has('password'))
                                                            <span class="help-block">
                                                                <strong><i class="fa fa-warning"></i> {{ $errors->first('password') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group has-feedback">
                                                            <label for="new_password">New Password <b style="color: red">*</b></label>
                                                            <input type="password" class="form-control" id="new_password" name="new_password" required="required" placeholder="Enter New Password">
                                                            @if ($errors->has('new_password'))
                                                            <span class="help-block">
                                                                <strong><i class="fa fa-warning"></i> {{ $errors->first('new_password') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group has-feedback">
                                                            <label for="re_password">Retype Password <b style="color: red">*</b></label>
                                                            <input type="password" class="form-control" id="re_password" name="re_password" required="required" placeholder="Retype Password">
                                                            @if ($errors->has('re_password'))
                                                            <span class="help-block">
                                                                <strong><i class="fa fa-warning"></i> {{ $errors->first('re_password') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xs-12">
                                                                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Submit</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="main-footer">
                <div class="container">
                    @include('frontend.layout.footer')
                </div>
            </footer>
        </div>
        <script src="{{asset('frontend/assets/js/jquery.js')}}"></script>
        <script src="{{asset('frontend/assets/js/bootstrap_min.js')}}"></script>
        <script src="{{asset('frontend/assets/js/slimscroll.min.js')}}"></script>
        <script src="{{asset('frontend/assets/js/fastclick.min.js')}}"></script>
        <script src="{{asset('frontend/assets/js/app_min.js')}}"></script>
        <script src="{{asset('frontend/assets/js/custom.js')}}"></script>
    </body>
</html>
