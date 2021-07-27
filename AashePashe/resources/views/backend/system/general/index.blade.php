<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Aashepashe | General Information</title>
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
                                    <div class="panel-heading panel-style"><i class="fa fa-clone"></i> System Settings | General Information</div>
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
                                                        <li class="active"><a href="{{ URL::to('portal/system') }}">General Info</a></li>
                                                        <li><a href="{{ URL::to('portal/about') }}">About Us</a></li>
                                                        <li><a href="{{ URL::to('portal/privacy') }}">Privacy & Policy</a></li>
                                                        <li><a href="{{ URL::to('portal/terms') }}">Terms & Conditions</a></li>
                                                        <li><a href="#">Contact Us</a></li>
                                                    </ul>
                                                    <div class="tab-content">
                                                        <div class="active tab-pane">
                                                            <div class="box box-primary">
                                                                <div class="box-header with-border">
                                                                    <h3 class="box-title">Edit General Information</h3>
                                                                </div>
                                                                <div class="box-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <form class="" action="{{ url('portal/system/update') }}" method="post" enctype="multipart/form-data">
                                                                                {{ csrf_field() }}
                                                                                <input type="hidden" name="system_settings_id" value="{{ $system_info->system_settings_id }}">
                                                                                <div class="form-group">
                                                                                    <label for="name">Name <b style="color: red">*</b></label>
                                                                                    <input type="text" maxlength="100" class="form-control" id="name" name="name" value="{{ $system_info->name }}" required="required">
                                                                                    @if ($errors->has('name'))
                                                                                    <span class="help-block">
                                                                                        <strong><i class="fa fa-warning"></i> {{ $errors->first('name') }}</strong>
                                                                                    </span>
                                                                                    @endif
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="short_name">Short Name <b style="color: red">*</b></label>
                                                                                    <input type="text" maxlength="15" class="form-control" id="short_name" name="short_name" value="{{ $system_info->short_name }}" required="required">
                                                                                    @if ($errors->has('short_name'))
                                                                                    <span class="help-block">
                                                                                        <strong><i class="fa fa-warning"></i> {{ $errors->first('short_name') }}</strong>
                                                                                    </span>
                                                                                    @endif
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="facebook">Facebook</label>
                                                                                    <input type="url" class="form-control" id="facebook" name="facebook" value="{{ $system_info->facebook }}">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="google">Google+</label>
                                                                                    <input type="url" class="form-control" id="google" name="google" value="{{ $system_info->google }}">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="youtube">YouTube</label>
                                                                                    <input type="url" class="form-control" id="youtube" name="youtube" value="{{ $system_info->youtube }}">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="linkedin">LinkedIn</label>
                                                                                    <input type="url" class="form-control" id="linkedin" name="linkedin" value="{{ $system_info->linkedin }}">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="twitter">Twitter</label>
                                                                                    <input type="url" class="form-control" id="twitter" name="twitter" value="{{ $system_info->twitter }}">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="sales_email">Sales Email</label>
                                                                                    <input type="email" maxlength="100" class="form-control" id="sales_email" name="sales_email" value="{{ $system_info->sales_email }}">
                                                                                </div>                                                                
                                                                                <div class="form-group">
                                                                                    <label for="sales_phone">Sales Phone</label>
                                                                                    <input type="text" class="form-control" id="sales_phone" name="sales_phone" value="{{ $system_info->sales_phone }}">
                                                                                </div>                                                                
                                                                                <div class="form-group">
                                                                                    <label for="support_email">Support Email</label>
                                                                                    <input type="email" maxlength="100" class="form-control" id="support_email" name="support_email" value="{{ $system_info->support_email }}">
                                                                                </div>                                                                
                                                                                <div class="form-group">
                                                                                    <label for="support_phone">Support Phone</label>
                                                                                    <input type="text" class="form-control" id="support_phone" name="support_phone" value="{{ $system_info->support_phone }}">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="billing_email">Billing Email</label>
                                                                                    <input type="email" maxlength="100" class="form-control" id="billing_email" name="billing_email" value="{{ $system_info->billing_email }}">
                                                                                </div>                                                                
                                                                                <div class="form-group">
                                                                                    <label for="billing_phone">Billing Phone</label>
                                                                                    <input type="text" class="form-control" id="billing_phone" name="billing_phone" value="{{ $system_info->billing_phone }}">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="address">Address</label>
                                                                                    <textarea class="form-control" name="address" id="address" rows="3">{{ $system_info->address }}</textarea>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="logo">Logo</label>
                                                                                    <input type="file" class="form-control" name="logo" id="logo">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="is_phone_verification">Is Phone Verification Required?</label>
                                                                                    <select class="form-control select2" id="is_phone_verification" name="is_phone_verification">
                                                                                        <option value="Yes"{{ $system_info->is_phone_verification == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                                        <option value="No"{{ $system_info->is_phone_verification == 'No' ? 'selected' : '' }}>No</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="is_email_verification">Is Email Verification Required?</label>
                                                                                    <select class="form-control select2" id="is_email_verification" name="is_email_verification">
                                                                                        <option value="Yes"{{ $system_info->is_email_verification == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                                        <option value="No"{{ $system_info->is_email_verification == 'No' ? 'selected' : '' }}>No</option>
                                                                                    </select>
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
                        </div>
                    </div>
                </section>
            </div>
            @include('backend.layout.footer')
        </div>
        @include('backend.layout.footer_script')
        <script type="text/javascript">
            $("#system_active").addClass("active");
            $("#system_active").parent().parent().addClass("treeview active");
            $("#system_active").parent().addClass("in");
        </script>
    </body>
</html>
