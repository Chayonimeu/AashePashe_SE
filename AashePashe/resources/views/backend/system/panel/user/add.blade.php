<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Aashepashe | Add User</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        @include('backend.layout.panel.header_script')
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            @include('backend.layout.panel.header')
            @include('backend.layout.panel.menu')
            <div class="content-wrapper">
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel-group">
                                <div class="panel panel-primary">
                                    <div class="panel-heading panel-style"><i class="fa fa-clone"></i> Add New User</div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-6">
                                                    <form role="form" class="" method="POST" action="{{ URL::to('portal/merchant/user/store') }}" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <div class="form-group">
                                                            <label for="name">Name <b style="color: red">*</b></label>
                                                            <input type="text" maxlength="100" placeholder="Enter Name" name="name" id="name" class="form-control" value="{{ old('name') }}" required/>
                                                            @if ($errors->has('name'))
                                                            <span class="help-block">
                                                                <strong><i class="fa fa-warning"></i> {{ $errors->first('name') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email">Email Address <b style="color: red">*</b></label>
                                                            <input type="email" maxlength="100" placeholder="Enter Email Address" name="email" id="email" class="form-control" value="{{ old('email') }}" required/>
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
                                                                    <option value="">--</option>
                                                                    @foreach($country_list AS $country)
                                                                    <option value="{{ $country->code }}"{{ (old('country_code') == $country->code) ? 'selected' : '' }}>{{ $country->name }} ({{ $country->code }})</option>
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
                                                            <label for="password">Password <b style="color: red">*</b></label>
                                                            <input type="password" maxlength="255" placeholder="Enter Password" name="password" id="password" class="form-control" value="" required/>
                                                            @if ($errors->has('password'))
                                                            <span class="help-block">
                                                                <strong><i class="fa fa-warning"></i> {{ $errors->first('password') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="re_password">Retype Password <b style="color: red">*</b></label>
                                                            <input type="password" maxlength="255" placeholder="Retype Password" name="re_password" id="re_password" class="form-control" value="" required/>
                                                            @if ($errors->has('re_password'))
                                                            <span class="help-block">
                                                                <strong><i class="fa fa-warning"></i> {{ $errors->first('re_password') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="status">Status <b style="color: red">*</b></label>
                                                            <select class="form-control select2" name="status" id="status" required>
                                                                <option value="Active"{{ (old('status') == 'Active') ? 'selected' : '' }}>Active</option>
                                                                <option value="Inactive"{{ (old('status') == 'Inactive') ? 'selected' : '' }}>Inactive</option>
                                                            </select>
                                                            @if ($errors->has('status'))
                                                            <span class="help-block">
                                                                <strong><i class="fa fa-warning"></i> {{ $errors->first('status') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Submit</button>
                                                    </form>
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
            @include('backend.layout.panel.footer')
        </div>
        @include('backend.layout.panel.footer_script')

        <script type="text/javascript">
            $("#merchant_user_active").addClass("active");
            $("#merchant_user_active").parent().parent().addClass("treeview active");
            $("#merchant_user_active").parent().addClass("in");
        </script>
    </body>
</html>
