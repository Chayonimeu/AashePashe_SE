<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Ashepashe | Verification Account</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap_min.css')}}" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{asset('frontend/assets/css/ion_icon.css')}}" />
        <link rel="stylesheet" href="{{asset('frontend/assets/css/template_main.css')}}" />
        <link rel="stylesheet" href="{{asset('frontend/assets/css/template_all_skin.css')}}" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <center>
                    <img class="img img-responsive" src="{{ asset('frontend/images/logo.png') }}" />
                </center>
            </div>
            <div class="login-box-body">
                <p class="text-center" style="font-weight: bold;color: maroon;font-size: 16px"><i class="fa fa-warning"></i> A verification code send to your mobile number. Please input the 6 digit code and verify your account.</p>
                <form action="" method="post">
                    <div class="form-group has-feedback">
                        <input type="text" maxlength="6" class="form-control" placeholder="Enter 6 Digit Code">
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-check"></i> Verify Account</button>
                        </div>
                    </div>
                </form>
                <div class="social-auth-links text-center">
                    <p style="font-weight: bold">- OR -</p>
                </div>
                <center>
                    <a href="{{ URL::to('/') }}" style="font-size: 16px">Back Home</a><br>
                </center>
            </div>
        </div>
        <script src="{{asset('frontend/assets/js/jquery.js')}}"></script>
        <script src="{{asset('frontend/assets/js/bootstrap_min.js')}}"></script>
    </body>
</html>
