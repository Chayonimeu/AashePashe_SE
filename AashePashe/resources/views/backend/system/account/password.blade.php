<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Aashepashe | Change Password</title>
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
                                    <div class="panel-heading panel-style"><i class="fa fa-clone"></i> Account Information</div>
                                    <div class="panel-body">
                                        @include('backend.layout.message')
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="box box-primary">
                                                    <div class="box-body box-profile">
                                                        @if (Auth::guard('admin')->user()->avatar == '')
                                                        <img src="{{ asset('backend/images/default.jpg') }}" alt="Image" class="profile-user-img img-responsive img-circle"/>
                                                        @else
                                                        <img src="{{ asset('upload/admin/avatar/'.Auth::guard('admin')->user()->avatar) }}" class="profile-user-img img-responsive img-circle" alt="Image"/>
                                                        @endif
                                                        <center>
                                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#avatar{{ Auth::guard('admin')->user()->admin_id }}" style="font-size: 12px"><i class="fa fa-image"></i> Change Avatar</a>
                                                        </center>
                                                        <h3 class="profile-username text-center">{{ Auth::guard('admin')->user()->name }}</h3>
                                                        <ul class="list-group list-group-unbordered">
                                                            <li class="list-group-item">
                                                                <small><i class="fa fa-envelope-square"></i> Email address</small><br>
                                                                <b>{{ Auth::guard('admin')->user()->email }}</b>
                                                            </li>
                                                            <li class="list-group-item">
                                                                <small><i class="fa fa-phone-square"></i> Phone Number</small><br>
                                                                <b>{{ Auth::guard('admin')->user()->phone }}</b>
                                                            </li>
                                                            <li class="list-group-item">
                                                                <small><i class="fa fa-filter"></i> Account Type</small><br>
                                                                <b>{{ Auth::guard('admin')->user()->type }}</b>
                                                            </li>
                                                        </ul>
                                                        <a href="{{ URL::to('portal/logout') }}" class="btn btn-primary btn-block btn-xs"><b><i class="fa fa-sign-out"></i> Sign Out</b></a>
                                                    </div>
                                                    <div id="avatar{{ Auth::guard('admin')->user()->admin_id }}" class="modal fade" role="dialog">
                                                        <div class="modal-dialog modal-md">
                                                            <div class="modal-content">
                                                                <form method="POST" enctype="multipart/form-data" action="{{ URL::to('portal/profile/avatar') }}">
                                                                    {{ csrf_field() }}
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                        <input type="hidden" name="admin_id" value="{{ Auth::guard('admin')->user()->admin_id }}" />
                                                                        <h4 class="modal-title">Change Your Profile Picture</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label for="avatar">Choose Image <b style="color: red">*</b></label>
                                                                            <input name="avatar" class="form-control" type="file" required="required">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Submit</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="nav-tabs-custom">
                                                    <ul class="nav nav-tabs">
                                                        <li><a href="{{ url::to('portal/profile') }}">Change Information</a></li>
                                                        <li class="active"><a href="{{ url::to('portal/password') }}">Change Password</a></li>
                                                    </ul>
                                                    <div class="tab-content">
                                                        <div class="active tab-pane">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <form action="{{ url('portal/password/update') }}" method="post" enctype="multipart/form-data">
                                                                        {{ csrf_field() }}
                                                                        <div class="form-group">
                                                                            <label for="password">Current Password <b style="color: red">*</b></label>
                                                                            <input type="password" class="form-control" id="password" name="password" value="" placeholder="Enter Current Password" required="required">
                                                                            @if ($errors->has('password'))
                                                                            <span class="help-block">
                                                                                <strong><i class="fa fa-warning"></i> {{ $errors->first('password') }}</strong>
                                                                            </span>
                                                                            @endif
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="new_password">New Password <b style="color: red">*</b></label>
                                                                            <input type="password" class="form-control" id="new_password" name="new_password" value="" placeholder="Enter New Password" required="required">
                                                                            @if ($errors->has('new_password'))
                                                                            <span class="help-block">
                                                                                <strong><i class="fa fa-warning"></i> {{ $errors->first('new_password') }}</strong>
                                                                            </span>
                                                                            @endif
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="confirm_password">Confirm Password <b style="color: red">*</b></label>
                                                                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" value="" placeholder="Retype New Password" required="required">
                                                                            @if ($errors->has('confirm_password'))
                                                                            <span class="help-block">
                                                                                <strong><i class="fa fa-warning"></i> {{ $errors->first('confirm_password') }}</strong>
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
    </body>
</html>
