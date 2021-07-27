<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Aashepashe | Create New Account</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap_min.css')}}" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{asset('frontend/assets/css/ion_icon.css')}}" />
        <link rel="stylesheet" href="{{asset('frontend/assets/css/template_main.css')}}" />
        <link rel="stylesheet" href="{{asset('frontend/assets/css/template_all_skin.css')}}" />
        <link rel="stylesheet" href="{{asset('frontend/assets/css/multiple_select_min.css')}}" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition login-page" style="background-color: #FFF">
        <div class="login-box">
            <div class="login-logo">
                <center>
                    <img class="img img-responsive" src="{{ asset('frontend/images/logo.png') }}" />
                </center>
            </div>
            <div class="login-box-body" style="border: 1px solid #48a0d6;">
                <h3 class="login-box-msg" >Get started with free account</h3>
                @include('frontend.layout.message')
                
                <form action="{{ URL::to('/save') }}" method="post">
                    {{ csrf_field() }}
                    <label for="phone">Phone Number <b style="color: red">*</b></label>
                    <div class="row">
                        <div class="col-sm-2 col-xs-4 col-md-4">
                            <select class="form-control select2" name="country_code" id="country_code" required="required">
                                <option value="">Code</option>
                                @foreach($country_list AS $country)
                                <option value="{{ $country->code }}">{{ $country->name }} ({{ $country->code }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-10 col-xs-8 col-md-8">
                            <div class="form-group">
                                <input type="text" required="required" class="form-control" placeholder="Enter Phone Number" id="phone" name="phone" value="{{ old('phone') }}" />
                                @if ($errors->has('phone'))
                                <span class="help-block">
                                    <strong><i class="fa fa-warning"></i> {{ $errors->first('phone') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="password">Password <b style="color: red">*</b></label>
                        <input type="password" class="form-control" id="password" name="password" value="" required="required" placeholder="Enter Password">
                        @if ($errors->has('password'))
                        <span class="help-block">
                            <strong><i class="fa fa-warning"></i> {{ $errors->first('password') }}</strong>
                        </span>
                        @endif    
                    </div>
                    <div class="form-group has-feedback">
                        <label for="re_password">Confirm Password <b style="color: red">*</b></label>
                        <input type="password" class="form-control" id="re_password" name="re_password" value="" required="required" placeholder="Enter Password Again">
                        @if ($errors->has('re_password'))
                        <span class="help-block">
                            <strong><i class="fa fa-warning"></i> {{ $errors->first('re_password') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-check"></i> Create Account</button>
                        </div>
                    </div>
                </form>
                <div class="social-auth-links text-center">
                    <a href="javascript:void(0)" class="btn btn-block btn-social btn-facebook"><i class="fa fa-facebook"></i> Sign up using Facebook</a>
                    <a href="javascript:void(0)" class="btn btn-block btn-social btn-google"><i class="fa fa-google-plus"></i> Sign up using Google+</a>
                </div>
                <a href="#" style="font-size: 16px"><i class="fa fa-key"></i> I forgot my password.</a><br>
                <a href="{{ URL::to('/login') }}" style="font-size: 16px"><i class="fa fa-sign-in"></i> Already have account. Sign in now.</a><br>
                <a href="{{ URL::to('/') }}" style="font-size: 16px"><i class="fa fa-home"></i> Back Home</a><br>
            </div>
        </div>
        <script src="{{asset('frontend/assets/js/jquery.js')}}"></script>
        <script src="{{asset('frontend/assets/js/bootstrap_min.js')}}"></script>
        <script src="{{asset('frontend/assets/js/multiple_select_full_min.js')}}">
        </script>
        <script>
            $(document).ready(function () {
                $('[data-toggle="tooltip"]').tooltip();
                $(".select2").select2();
            });
        </script>
    </body>
</html>
