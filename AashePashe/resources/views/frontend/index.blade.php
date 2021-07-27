<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>AashePashe | Deal With Your Hotel Booking, Restaurant Booking, Flight Booking, Nearby Services and Find Nearby Peoples</title>
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
                        <div class="navbar-custom-menu">
                            <ul class="nav navbar-nav">
                                <li class="dropdown">
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#merchant_section"><span class="glyphicon glyphicon-user"></span> Merchant World</a>

                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> My Account</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ URL::to('login') }}"><span class="glyphicon glyphicon-cog"></span>Account Settings</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#"><span class="glyphicon glyphicon-heart"></span> My Coupons</a></li>
                                        <li class="divider"></li><li><a href="#"><span class="fa fa-sign-out"></span> Sign Out</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
            <div class="content-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-9">
                                <div id="carousel-example-generic" class="carouse                                                                                                                                                                                                        l slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                        <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                                        <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                                    </ol>
                                    <div class="carousel-inner">
                                        <div class="item active">
                                            <img style="width: 100%;height: 300px" src="{{ asset('frontend/images/b3.jpg') }}" alt="First slide" class="img img-responsive">
                                            <div class="carousel-caption">
                                                First Slide
                                            </div>
                                        </div>
                                        <div class="item">
                                            <img style="width: 100%;height: 300px" src="{{ asset('frontend/images/b3.jpg') }}" alt="Second slide" class="img img-responsive">
                                            <div class="carousel-caption">
                                                Second Slide
                                            </div>
                                        </div>
                                        <div class="item">
                                            <img style="width: 100%;height: 300px" src="{{ asset('frontend/images/b3.jpg') }}" alt="Third slide" class="img img-responsive">
                                            <div class="carousel-caption">
                                                Third Slide
                                            </div>
                                        </div>
                                    </div>
                                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                        <span class="fa fa-angle-left"></span>
                                    </a>
                                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                        <span class="fa fa-angle-right"></span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="box box-widget widget-user-2">
                                    <div class="widget-user-header bg-aqua-active">
                                        <div class="widget-user-image">
                                            <center>
                                                <img class="img-circle" src="{{ asset('frontend/images/avatar.jpg') }}" alt="Avatar">
                                            </center>
                                        </div>
                                        <h3 class="widget-user-username">Hi guest</h3>
                                        <h5 class="widget-user-desc"></h5>
                                    </div>
                                    <div class="box-footer">
                                        <a href="{{ URL::to('/register') }}" class="btn btn-danger btn-block btn-sm" style="font-size: 16px"><i class="fa fa-check"></i> Register Your Account</a>
                                        <center>
                                            <a style="font-weight: bold;font-size: 20px;">OR</a>
                                        </center>
                                        <a href="{{ URL::to('/login') }}" class="btn btn-primary btn-block btn-sm" style="font-size: 16px"><i class="fa fa-sign-in"></i> Login Into                                                                                                                                                                                                         Account</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="margin-top: 20px;margin-bottom: 20px">
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card my-card"><span class="fa fa-hotel" aria-hidden="true"></span></div>
                                    <h4 style="">Hotels</h4>
                                    <h1>200</h1>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card my-card"><span class="fa fa-cc-diners-club" aria-hidden="true"></span></div>
                                    <h4 style="">Restaurants</h4>
                                    <h1>250</h1>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card my-card"><span class="fa fa-cogs" aria-hidden="true"></span></div>
                                    <h4 style="">Services</h4>
                                    <h1>50</h1>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card my-card"><span class="fa fa-plane" aria-hidden="true"></span></div>
                                    <h4 style="">Flights</h4>
                                    <h1>20</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <div class="box box-info">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"><i class="fa fa-hotel"></i> Hotels</h3>
                                    </div>
                                    <div class="box-body">
                                        <section class="hotel_slider slider">
                                            <div class="slide">
                                                <a href=""title="Name Goes Here">
                                                    <img src="{{ asset('frontend/images/h4.jfif') }}">
                                                    <h5>Royal Park Residence</h5>
                                                </a>
                                                <span>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                </span>
                                                <a href="javascript:void(0)" style="color: #000000"><span>120 reviews</span></a>
                                                <p>From <span  style="color: red;font-size: 20px">300৳</span></p>
                                            </div>
                                            <div class="slide">
                                                <a href=""title="Name Goes Here">
                                                    <img src="{{ asset('frontend/images/h6.jpg') }}">
                                                    <h5>The WAY Dhaka</h5>
                                                </a>
                                                <span>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                </span>
                                                <a href="javascript:void(0)" style="color: #000000"><span>120 reviews</span></a>
                                                <p>From <span  style="color: red;font-size: 20px">200৳</span></p>
                                            </div>
                                            <div class="slide">
                                                <a href="" title="Name Goes Here">
                                                    <img src="{{ asset('frontend/images/h5.jpg') }}">
                                                    <h5>Le Meridien Dhaka</h5>
                                                </a>
                                                <span>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                </span>
                                                <a href="javascript:void(0)" style="color: #000000"><span>120 reviews</span></a>
                                                <p>From <span  style="color: red;font-size: 20px">300৳</span></p>
                                            </div>
                                            <div class="slide">
                                                <a href="" title="Name Goes Here">
                                                    <img src="{{ asset('frontend/images/h6.jpg') }}">
                                                    <h5>The Westin Dhaka</h5>
                                                </a>
                                                <span>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                </span>
                                                <a href="javascript:void(0)" style="color: #000000"><span>120 reviews</span></a>
                                                <p>From <span  style="color: red;font-size: 20px">400৳</span></p>
                                            </div>
                                            <div class="slide">
                                                <a href="" title="Name Goes Here">
                                                    <img src="{{ asset('frontend/images/h5.jpg') }}">
                                                    <h5>Pan Pacific Sonargaon</h5>
                                                </a>
                                                <span>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                </span>
                                                <a href="javascript:void(0)" style="color: #000000"><span>120 reviews</span></a>
                                                <p>From <span  style="color: red;font-size: 20px">300৳</span></p>
                                            </div>
                                            <div class="slide">
                                                <a href="" title="Name Goes Here">
                                                    <img src="{{ asset('frontend/images/h6.jpg') }}">
                                                    <h5>Le Meridien Dhaka</h5>
                                                </a>
                                                <span>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                </span>
                                                <a href="javascript:void(0)" style="color: #000000"><span>120 reviews</span></a>
                                                <p>From <span  style="color: red;font-size: 20px">300৳</span></p>
                                            </div>
                                            <div class="slide">
                                                <a href="" title="Name Goes Here">
                                                    <img src="{{ asset('frontend/images/h5.jpg') }}">
                                                    <h5>Royal Park Residence</h5>
                                                </a>
                                                <span>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                </span>
                                                <a href="javascript:void(0)" style="color: #000000"><span>120 reviews</span></a>
                                                <p>From <span  style="color: red;font-size: 20px">300৳</span></p>
                                            </div>
                                            <div class="slide">
                                                <a href="" title="Name Goes Here">
                                                    <img src="{{ asset('frontend/images/h7.jfif') }}">
                                                    <h5>Pan Pacific Sonargaon</h5>
                                                </a>
                                                <span>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                </span>
                                                <a href="javascript:void(0)" style="color: #000000"><span>120 reviews</span></a>
                                                <p>From <span  style="color: red;font-size: 20px">300৳</span></p>
                                            </div>
                                            <div class="slide">
                                                <a href="" title="Name Goes Here">
                                                    <img src="{{ asset('frontend/images/h6.jpg') }}">
                                                    <h5>Le Meridien Dhaka</h5>
                                                </a>
                                                <span>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                </span>
                                                <a href="javascript:void(0)" style="color: #000000"><span>120 reviews</span></a>
                                                <p>From <span  style="color: red;font-size: 20px">300৳</span></p>
                                            </div>
                                            <div class="slide">
                                                <a href="" title="Name Goes Here">
                                                    <img src="{{ asset('frontend/images/h7.jfif') }}">
                                                    <h5>Pan Pacific Sonargaon</h5>
                                                </a>
                                                <span>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                </span>
                                                <a href="javascript:void(0)" style="color: #000000"><span>120 reviews</span></a>
                                                <p>From <span  style="color: red;font-size: 20px">300৳</span></p>
                                            </div>
                                            <div class="slide">
                                                <a href="" title="Name Goes Here">
                                                    <img src="{{ asset('frontend/images/h5.jpg') }}">
                                                    <h5>Royal Park Residence</h5>
                                                </a>
                                                <span>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                </span>
                                                <a href="javascript:void(0)" style="color: #000000"><span>120 reviews</span></a>
                                                <p>From <span  style="color: red;font-size: 20px">400৳</span></p>
                                            </div>
                                        </section>
                                    </div>
                                    <div class="box-footer text-right">
                                        <a href="" style="font-size: 16px">More <i class="fa fa-chevron-right"></i></a>
                                    </div>
                                </div>
                                <div class="box box-info">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"><i class="fa fa-spoon"></i> Restaurant</h3>
                                    </div>
                                    <div class="box-body">
                                        <section class="restaurant_slider slider">
                                            <div class="slide">
                                                <a href=""title="Name Goes Here">
                                                    <img src="{{ asset('frontend/images/h1.jpg') }}">
                                                    <h5>Star Kabab & Restaurant</h5>
                                                </a>
                                                <span>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star-half-empty icon"></i>
                                                </span>
                                                <a href="javascript:void(0)" style="color: #000000"><span>120 reviews</span></a>
                                            </div>
                                            <div class="slide">
                                                <a href=""title="Name Goes Here">
                                                    <img src="{{ asset('frontend/images/h2.jpg') }}">
                                                    <h5>Nirob Hotel Restaurant</h5>
                                                </a>
                                                <span>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                </span>
                                                <a href="javascript:void(0)" style="color: #000000"><span>120 reviews</span></a>
                                            </div>
                                            <div class="slide">
                                                <a href="" title="Name Goes Here">
                                                    <img src="{{ asset('frontend/images/h3.jpg') }}">
                                                    <h5>Star Kabab & Restaurant</h5>
                                                </a>
                                                <span>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                </span>
                                                <a href="javascript:void(0)" style="color: #000000"><span>120 reviews</span></a>
                                            </div>
                                            <div class="slide">
                                                <a href="" title="Name Goes Here">
                                                    <img src="{{ asset('frontend/images/h1.jpg') }}">
                                                    <h5>Hazir Biriani</h5>
                                                </a>
                                                <span>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                </span>
                                                <a href="javascript:void(0)" style="color: #000000"><span>120 reviews</span></a>
                                            </div>
                                            <div class="slide">
                                                <a href="" title="Name Goes Here">
                                                    <img src="{{ asset('frontend/images/h2.jpg') }}">
                                                    <h5>Star Kabab & Restaurant</h5>
                                                </a>
                                                <span>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                </span>
                                                <a href="javascript:void(0)" style="color: #000000"><span>120 reviews</span></a>
                                            </div>
                                            <div class="slide">
                                                <a href="" title="Name Goes Here">
                                                    <img src="{{ asset('frontend/images/h3.jpg') }}">
                                                    <h5>Hazir Biriani</h5>
                                                </a>
                                                <span>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                </span>
                                                <a href="javascript:void(0)" style="color: #000000"><span>120 reviews</span></a>
                                            </div>
                                            <div class="slide">
                                                <a href="" title="Name Goes Here">
                                                    <img src="{{ asset('frontend/images/h1.jpg') }}">
                                                    <h5>Star Kabab & Restaurant</h5>
                                                </a>
                                                <span>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                </span>
                                                <a href="javascript:void(0)" style="color: #000000"><span>120 reviews</span></a>
                                            </div>
                                            <div class="slide">
                                                <a href="" title="Name Goes Here">
                                                    <img src="{{ asset('frontend/images/h2.jpg') }}">
                                                    <h5>Nirob Hotel Restaurant</h5>
                                                </a>
                                                <span>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                </span>
                                                <a href="javascript:void(0)" style="color: #000000"><span>120 reviews</span></a>
                                            </div>
                                            <div class="slide">
                                                <a href="" title="Name Goes Here">
                                                    <img src="{{ asset('frontend/images/h3.jpg') }}">
                                                    <h5>Star Kabab & Restaurant</h5>
                                                </a>
                                                <span>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                </span>
                                                <a href="javascript:void(0)" style="color: #000000"><span>120 reviews</span></a>
                                            </div>
                                            <div class="slide">
                                                <a href="" title="Name Goes Here">
                                                    <img src="{{ asset('frontend/images/h1.jpg') }}">
                                                    <h5>Star Kabab & Restaurant</h5>
                                                </a>
                                                <span>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                </span>
                                                <a href="javascript:void(0)" style="color: #000000"><span>120 reviews</span></a>
                                            </div>
                                            <div class="slide">
                                                <a href="" title="Name Goes Here">
                                                    <img src="{{ asset('frontend/images/h2.jpg') }}">
                                                    <h5>Hazir Biriani</h5>
                                                </a>
                                                <span>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                </span>
                                                <a href="javascript:void(0)" style="color: #000000"><span>120 reviews</span></a>
                                            </div>
                                        </section>
                                    </div>
                                    <div class="box-footer text-right">
                                        <a href="" style="font-size: 16px">More <i class="fa fa-chevron-right"></i></a>
                                    </div>
                                </div>
                                <div class="box box-info">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"><i class="fa fa-spoon"></i> Food Delivery Shop</h3>
                                    </div>
                                    <div class="box-body">
                                        <section class="food_slider slider">
                                            <div class="slide">
                                                <a href=""title="Name Goes Here">
                                                    <img src="{{ asset('frontend/images/h1.jpg') }}">
                                                    <h5>Star Kabab & Restaurant</h5>
                                                </a>
                                                <span>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star-half-empty icon"></i>
                                                </span>
                                                <a href="javascript:void(0)" style="color: #000000"><span>120 reviews</span></a>
                                            </div>
                                            <div class="slide">
                                                <a href=""title="Name Goes Here">
                                                    <img src="{{ asset('frontend/images/h2.jpg') }}">
                                                    <h5>Nirob Hotel Restaurant</h5>
                                                </a>
                                                <span>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                </span>
                                                <a href="javascript:void(0)" style="color: #000000"><span>120 reviews</span></a>
                                            </div>
                                            <div class="slide">
                                                <a href="" title="Name Goes Here">
                                                    <img src="{{ asset('frontend/images/h3.jpg') }}">
                                                    <h5>Star Kabab & Restaurant</h5>
                                                </a>
                                                <span>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                </span>
                                                <a href="javascript:void(0)" style="color: #000000"><span>120 reviews</span></a>
                                            </div>
                                            <div class="slide">
                                                <a href="" title="Name Goes Here">
                                                    <img src="{{ asset('frontend/images/h1.jpg') }}">
                                                    <h5>Hazir Biriani</h5>
                                                </a>
                                                <span>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                </span>
                                                <a href="javascript:void(0)" style="color: #000000"><span>120 reviews</span></a>
                                            </div>
                                            <div class="slide">
                                                <a href="" title="Name Goes Here">
                                                    <img src="{{ asset('frontend/images/h2.jpg') }}">
                                                    <h5>Star Kabab & Restaurant</h5>
                                                </a>
                                                <span>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                </span>
                                                <a href="javascript:void(0)" style="color: #000000"><span>120 reviews</span></a>
                                            </div>
                                            <div class="slide">
                                                <a href="" title="Name Goes Here">
                                                    <img src="{{ asset('frontend/images/h3.jpg') }}">
                                                    <h5>Hazir Biriani</h5>
                                                </a>
                                                <span>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                </span>
                                                <a href="javascript:void(0)" style="color: #000000"><span>120 reviews</span></a>
                                            </div>
                                            <div class="slide">
                                                <a href="" title="Name Goes Here">
                                                    <img src="{{ asset('frontend/images/h1.jpg') }}">
                                                    <h5>Star Kabab & Restaurant</h5>
                                                </a>
                                                <span>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                </span>
                                                <a href="javascript:void(0)" style="color: #000000"><span>120 reviews</span></a>
                                            </div>
                                            <div class="slide">
                                                <a href="" title="Name Goes Here">
                                                    <img src="{{ asset('frontend/images/h2.jpg') }}">
                                                    <h5>Nirob Hotel Restaurant</h5>
                                                </a>
                                                <span>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                </span>
                                                <a href="javascript:void(0)" style="color: #000000"><span>120 reviews</span></a>
                                            </div>
                                            <div class="slide">
                                                <a href="" title="Name Goes Here">
                                                    <img src="{{ asset('frontend/images/h3.jpg') }}">
                                                    <h5>Star Kabab & Restaurant</h5>
                                                </a>
                                                <span>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                </span>
                                                <a href="javascript:void(0)" style="color: #000000"><span>120 reviews</span></a>
                                            </div>
                                            <div class="slide">
                                                <a href="" title="Name Goes Here">
                                                    <img src="{{ asset('frontend/images/h1.jpg') }}">
                                                    <h5>Star Kabab & Restaurant</h5>
                                                </a>
                                                <span>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                </span>
                                                <a href="javascript:void(0)" style="color: #000000"><span>120 reviews</span></a>
                                            </div>
                                            <div class="slide">
                                                <a href="" title="Name Goes Here">
                                                    <img src="{{ asset('frontend/images/h2.jpg') }}">
                                                    <h5>Hazir Biriani</h5>
                                                </a>
                                                <span>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                    <i class="fa fa-star icon"></i>
                                                </span>
                                                <a href="javascript:void(0)" style="color: #000000"><span>120 reviews</span></a>
                                            </div>
                                        </section>
                                    </div>
                                    <div class="box-footer text-right">
                                        <a href="" style="font-size: 16px">More <i class="fa fa-chevron-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="thumbnail center text-center">
                                    <h2>Save Money, Save Time</h2>
                                    <p>Subscribe to our newsletter and stay tuned. We will send the best deals to you.</p>
                                    <form action="" method="post">
                                        <center>
                                            <div class="form-group">
                                                <input class="form-control" style="width: 50%" type="text" id="" name="" placeholder="your@email.com">
                                            </div>
                                            <button class="btn btn-primary" type="button" style="margin-bottom: 20px"><i class="fa fa-envelope"></i> Subscribe Now</button>
                                        </center>
                                    </form>
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
        <div id="merchant_section" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Merchant World</h4>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="col-md-6" style="height: 200px;border: 1px solid #ecf0f5">
                                <center>
                                    <i style="margin-top: 20px;" class="fa fa-lock fa-5x"></i>
                                    <h4>Sign In Your Merchant Account</h4>
                                    <a href="{{ URL::to('merchant/login') }}" class="btn btn-primary btn-block btn-sm" style="font-size: 16px"><i class="fa fa-sign-in"></i> Sign In</a>
                                </center>
                            </div>
                            <div class="col-md-6" style="height: 200px;border: 1px solid #ecf0f5">
                                <center>
                                    <i style="margin-top: 20px" class="fa fa-user-secret fa-5x"></i>
                                    <h4>Register Your Merchant Account</h4>
                                    <a href="{{ URL::to('/merchant/register') }}" class="btn btn-danger btn-block btn-sm" style="font-size: 16px"><i class="fa fa-check"></i> Register Now</a>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{asset('frontend/assets/js/jquery.js')}}"></script>
        <script src="{{asset('frontend/assets/js/bootstrap_min.js')}}"></script>
        <script src="{{asset('frontend/assets/js/slimscroll.min.js')}}"></script>
        <script src="{{asset('frontend/assets/js/fastclick.min.js')}}"></script>
        <script src="{{asset('frontend/assets/js/app_min.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
        <script src="{{asset('frontend/assets/js/custom.js')}}"></script>
    </body>
</html>
