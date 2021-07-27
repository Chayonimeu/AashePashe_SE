<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Aashepashe | Create Merchant Account</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap_min.css')}}" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{asset('frontend/assets/css/ion_icon.css')}}" />
        <link rel="stylesheet" href="{{asset('frontend/assets/css/template_main.css')}}" />
        <link rel="stylesheet" href="{{asset('frontend/assets/css/template_all_skin.css')}}" />
        <link rel="stylesheet" href="{{asset('frontend/assets/css/custom_style.css')}}" />
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
        <div style="margin-top: 30px">
            <center>
                <img class="img img-responsive" src="{{ asset('frontend/images/logo.png') }}" />
                <h3>Register Your Merchant Account Within Few Moments</h3>
            </center>
        </div>
        <div class="row">
            <form role="form" method="POST" action="{{ URL::to('merchant/save') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="col-md-6 col-md-offset-3" style="margin-bottom: 30px">
                    @include('frontend.layout.message')
                    <div class="panel panel-primary" style="border: 1px solid #48a0d6">
                        <div class="panel-heading" style="background: #48a0d6;font-weight: bold"><i class="fa fa-clone"></i> Owner Information</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="control-label" for="name">Name <b style="color: red">*</b></label>
                                <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Owner Name" id="name" name="name" value="{{ old('name') }}" />
                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong><i class="fa fa-warning"></i> {{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="email">Email Address <b style="color: red">*</b></label>
                                <input maxlength="100" type="email" required="required" class="form-control" placeholder="Enter Email Address" id="email" name="email" value="{{ old('email') }}" />
                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong><i class="fa fa-warning"></i> {{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                            <label class="control-label" for="phone">Phone Number <b style="color: red">*</b></label>
                            <div class="row">
                                <div class="col-sm-2 col-xs-4 col-md-4">
                                    <select class="form-control select2" name="country_code" id="country_code" required="required">
                                        <option value="">Country Code</option>
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
                            <div class="form-group">
                                <label class="control-label" for="password">Set Password <b style="color: red">*</b></label>
                                <input type="password" maxlength="255" required="required" class="form-control" placeholder="Enter Password" id="password" name="password" value="" />
                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong><i class="fa fa-warning"></i> {{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="re_password">Confirm Password <b style="color: red">*</b></label>
                                <input type="password" maxlength="255" required="required" class="form-control" placeholder="Retype Password" id="re_password" name="re_password" value="" />
                                @if ($errors->has('re_password'))
                                <span class="help-block">
                                    <strong><i class="fa fa-warning"></i> {{ $errors->first('re_password') }}</strong>
                                </span>
                                @endif
                            </div>        
                        </div>
                    </div>
                    <div class="panel panel-primary" style="border: 1px solid #48a0d6">
                        <div class="panel-heading" style="background: #48a0d6;font-weight: bold"><i class="fa fa-clone"></i> Company Information</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="control-label" for="company_name">Name <b style="color: red">*</b></label>
                                <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Company Name" id="company_name" name="company_name" value="{{ old('company_name') }}" />
                                @if ($errors->has('company_name'))
                                <span class="help-block">
                                    <strong><i class="fa fa-warning"></i> {{ $errors->first('company_name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="category_id">Business Type <b style="color: red">*</b></label>
                                <select class="form-control select2" id="category_id" name="category_id" required="required">
                                    <option value="">Choose Type</option>
                                    @foreach($category_list AS $category)
                                    <option value="{{ $category->category_id }}"{{ (old('category_id') == $category->category_id) ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category_id'))
                                <span class="help-block">
                                    <strong><i class="fa fa-warning"></i> {{ $errors->first('category_id') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="company_logo">Logo</label>
                                <input type="file" class="form-control" id="company_logo" name="company_logo" />
                                <small style="color: darkred"><i class="fa fa-info-circle"></i> File size must be less than 1MB</small>
                                @if ($errors->has('company_logo'))
                                <span class="help-block">
                                    <strong><i class="fa fa-warning"></i> {{ $errors->first('company_logo') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="company_address">Address <b style="color: red">*</b></label>
                                <textarea class="form-control" id="company_address" name="company_address" required="required">{{ old('company_address') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-block"><i class="fa fa-check"></i> Create Account</button>
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3" style="margin-top: -10px">
                @include('frontend/layout/footer_other')
            </div>
        </div>
        <script src="{{asset('frontend/assets/js/jquery.js')}}"></script>
        <script src="{{asset('frontend/assets/js/bootstrap_min.js')}}"></script>
        <script src="{{asset('frontend/assets/js/multiple_select_full_min.js')}}">
        </script>
        <script>
            $(document).ready(function () {
                $(".select2").select2();
            });
        </script>
    </body>
</html>
