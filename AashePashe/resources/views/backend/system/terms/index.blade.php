<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Aashepashe | Terms & Conditions</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        @include('backend.layout.header_script')
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            @include('backend.layout.header')
            @include('backend.layout.menu')
            <div class="content-wrapper">
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel-group">
                                <div class="panel panel-primary">
                                    <div class="panel-heading panel-style"><i class="fa fa-clone"></i> System Settings | Terms & Conditions</div>
                                    <div class="panel-body">
                                        @include('backend.layout.message')
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="box box-primary">
                                                    <div class="box-body box-profile">
                                                        <center>
                                                            @if ($system_info->logo == '')
                                                            <img src="{{ asset('backend/images/logo.png') }}" alt="Logo" class="img img-responsive" style="max-height: 100px"/>
                                                            @else
                                                            <img src="{{ url('upload/'.$system_info->logo) }}" alt="Logo" class="img img-responsive" style="max-height: 100px;" />
                                                            @endif
                                                        </center>
                                                        <h4 class="text-center">{{ $system_info->name }}</h4>
                                                        <h5 class="text-center" style="color: darkred;font-weight: bold">{{ $system_info->short_name }}</h5>
                                                        <ul class="list-group list-group-unbordered">
                                                            <li class="list-group-item">
                                                                <small><i class="fa fa-envelope-square"></i> Sales Email</small><br>
                                                                <b>{{ $system_info->sales_email }}</b><br>
                                                                <small><i class="fa fa-phone-square"></i> Sales Phone</small><br>
                                                                <b>{{ $system_info->sales_phone }}</b>
                                                            </li>
                                                            <li class="list-group-item">
                                                                <small><i class="fa fa-envelope-square"></i> Support Email</small><br>
                                                                <b>{{ $system_info->support_email }}</b><br>
                                                                <small><i class="fa fa-phone-square"></i> Support Phone</small><br>
                                                                <b>{{ $system_info->support_phone }}</b>
                                                            </li>
                                                            <li class="list-group-item">
                                                                <small><i class="fa fa-envelope-square"></i> Billing Email</small><br>
                                                                <b>{{ $system_info->billing_email }}</b><br>
                                                                <small><i class="fa fa-phone-square"></i> Billing Phone</small><br>
                                                                <b>{{ $system_info->billing_phone }}</b>
                                                            </li>
                                                            <li class="list-group-item">
                                                                <small><i class="fa fa-location-arrow"></i> Company Address</small><br>
                                                                <b>{{ $system_info->address }}</b>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="box box-primary">
                                                    <div class="box-header with-border">
                                                        <h3 class="box-title">Social Media</h3>
                                                    </div>
                                                    <div class="box-body">
                                                        <strong><i class="fa fa-facebook-square"></i> Facebook</strong>
                                                        <p class="text-muted">{{ $system_info->facebook }}</p>
                                                        <strong><i class="fa fa-google-plus-square"></i> Google+</strong>
                                                        <p class="text-muted">{{ $system_info->google }}</p>
                                                        <strong><i class="fa fa-youtube-square"></i> Youtube</strong>
                                                        <p class="text-muted">{{ $system_info->youtube }}</p>
                                                        <strong><i class="fa fa-linkedin-square"></i> Linkedin</strong>
                                                        <p class="text-muted">{{ $system_info->linkedin }}</p>
                                                        <strong><i class="fa fa-twitter-square"></i> Twitter</strong>
                                                        <p class="text-muted">{{ $system_info->twitter }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="nav-tabs-custom">
                                                    <ul class="nav nav-tabs">
                                                        <li><a href="{{ URL::to('portal/system') }}">General Info</a></li>
                                                        <li><a href="{{ URL::to('portal/about') }}">About Us</a></li>
                                                        <li><a href="{{ URL::to('portal/privacy') }}">Privacy & Policy</a></li>
                                                        <li  class="active"><a href="{{ URL::to('portal/terms') }}">Terms & Conditions</a></li>
                                                        <li><a href="#">Contact Us</a></li>
                                                    </ul>
                                                    <div class="tab-content">
                                                        <div class="active tab-pane">
                                                            <div class="box box-primary">
                                                                <div class="box-header with-border">
                                                                    <h3 class="box-title">Terms & Conditions</h3>
                                                                </div>
                                                                <div class="box-body">
                                                                    <form class="" action="{{ url('portal/terms/update') }}" method="post" enctype="multipart/form-data">
                                                                        {{ csrf_field() }}
                                                                        <input type="hidden" name="system_settings_id" value="{{ $system_info->system_settings_id }}">
                                                                        <div class="form-group">
                                                                            <label for="terms" class="control-label">Terms & Conditions <b style="color: red">*</b></label>
                                                                            <textarea class="form-control" name="terms" id="terms" required="required">{{ $system_info->terms }}</textarea>
                                                                            @if ($errors->has('terms'))
                                                                            <span class="help-block">
                                                                                <strong><i class="fa fa-warning"></i> {{ $errors->first('terms') }}</strong>
                                                                            </span>
                                                                            @endif
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Submit</button>
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
                        </div>
                    </div>
                </section>
            </div>
            @include('backend.layout.footer')
        </div>
        @include('backend.layout.footer_script')
        <script src="https://adminlte.io/themes/AdminLTE/bower_components/ckeditor/ckeditor.js">
        </script>
        <script>
            $(document).ready(function () {
                CKEDITOR.replace('terms');
            });
        </script>
        <script type="text/javascript">
            $("#system_active").addClass("active");
            $("#system_active").parent().parent().addClass("treeview active");
            $("#system_active").parent().addClass("in");
        </script>
    </body>
</html>
