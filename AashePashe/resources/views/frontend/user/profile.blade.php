<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>AashePashe | Change Account Information</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap_min.css')}}" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{asset('frontend/assets/css/ion_icon.css')}}" />
        <link rel="stylesheet" href="{{asset('frontend/assets/css/template_main.css')}}" />
        <link rel="stylesheet" href="{{asset('frontend/assets/css/template_all_skin.css')}}" />
        <link rel="stylesheet" href="{{asset('frontend/assets/css/custom_style.css')}}" />
        <link rel="stylesheet" href="{{asset('frontend/assets/css/multiple_select_min.css')}}" />
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/datePicker.css') }}" />
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
                                                <li class="active"><a href="{{ URL::to('dashboard') }}"><i class="fa fa-user"></i> Account Information</a></li>
                                                <li><a href="{{ URL::to('change/password') }}"><i class="fa fa-lock"></i> Change Password</a></li>
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
                                        <div class="panel-heading">Change Account Information</div>
                                        <div class="panel-body">
                                            <form action="{{ URL::to('/update/information') }}" method="POST">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="user_id" value="{{ Auth::user()->user_id }}" />
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="first_name">First Name <b style="color: red">*</b></label>
                                                                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ Auth::user()->first_name }}" required="required" placeholder="Enter First Name">
                                                                @if ($errors->has('first_name'))
                                                                <span class="help-block">
                                                                    <strong><i class="fa fa-warning"></i> {{ $errors->first_name('first_name') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="last_name">Last Name <b style="color: red">*</b></label>
                                                                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ Auth::user()->last_name }}" required="required" placeholder="Enter Last Name">
                                                                @if ($errors->has('last_name'))
                                                                <span class="help-block">
                                                                    <strong><i class="fa fa-warning"></i> {{ $errors->first('last_name') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="email">Email Address <b style="color: red">*</b></label>
                                                                <input type="email" class="form-control" id="email" name="email" required="required" value="{{ Auth::user()->email }}" placeholder="Enter Email Address">
                                                                @if ($errors->has('email'))
                                                                <span class="help-block">
                                                                    <strong><i class="fa fa-warning"></i> {{ $errors->first('email') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="phone">Phone Number <b style="color: red">*</b></label>
                                                                <input type="text" class="form-control" id="phone" name="phone" readonly="readonly" value="{{ Auth::user()->country_code }}{{ Auth::user()->phone }}" placeholder="Enter Phone Number">
                                                                @if ($errors->has('phone'))
                                                                <span class="help-block">
                                                                    <strong><i class="fa fa-warning"></i> {{ $errors->first('phone') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="gender">Gender</label>
                                                                <select class="form-control select2" id="gender" name="gender">
                                                                    <option value="">Select Gender</option>
                                                                    <option value="Male"{{ (Auth::user()->gender == 'Male') ? 'selected' : '' }}>Male</option>
                                                                    <option value="Female"{{ (Auth::user()->gender == 'Female') ? 'selected' : '' }}>Female</option>
                                                                    <option value="Others"{{ (Auth::user()->gender == 'Others') ? 'selected' : '' }}>Others</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="dob">Date of Birth</label>
                                                                <div class="input-group date">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input type="text" class="form-control pull-right" id="datepicker" name="dob" value="{{ Auth::user()->dob }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="address">Address</label>
                                                                <textarea class="form-control" id="address" name="address">{{ Auth::user()->address }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="col-md-12">
                                                            <button class="btn btn-primary"><i class="fa fa-check"></i> Submit</button>
                                                        </div>
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
        <script src="{{asset('frontend/assets/js/multiple_select_full_min.js')}}"></script>
        <script src="{{ asset('frontend/assets/js/date_picker.js') }}">
        </script>
        <script>
            $(document).ready(function () {
                $(".select2").select2();
                $('.date').datepicker({
                    format: 'dd/mm/yyyy'
                });
            });
        </script>
    </body>
</html>
