<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Aashepashe | Edit Country</title>
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
                                    <div class="panel-heading panel-style"><i class="fa fa-clone"></i> Edit Country
                                        <a href="{{ url()->previous() }}" class="pull-right"><i class="fa fa-arrow-circle-left"></i> Go Back</a>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-6">
                                                    <form role="form" class="" method="POST" action="{{ URL::to('portal/country/update') }}" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="country_id" value="{{ $country_list->country_id }}" />
                                                        <div class="form-group">
                                                            <label for="name">Name <b style="color: red">*</b></label>
                                                            <input type="text" maxlength="100" placeholder="Enter Name" name="name" id="name" class="form-control" value="{{ $country_list->name }}" required/>
                                                            @if ($errors->has('name'))
                                                            <span class="help-block">
                                                                <strong><i class="fa fa-warning"></i> {{ $errors->first('name') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="short_name">Short Name <b style="color: red">*</b></label>
                                                            <input type="text" maxlength="50" placeholder="Enter Short Name" name="short_name" id="short_name" class="form-control" value="{{ $country_list->short_name }}" required/>
                                                            @if ($errors->has('short_name'))
                                                            <span class="help-block">
                                                                <strong><i class="fa fa-warning"></i> {{ $errors->first('short_name') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="code">Calling Code <b style="color: red">*</b></label>
                                                            <input type="text" maxlength="15" placeholder="Enter Calling Code" name="code" id="code" class="form-control" value="{{ $country_list->code }}" required/>
                                                            @if ($errors->has('code'))
                                                            <span class="help-block">
                                                                <strong><i class="fa fa-warning"></i> {{ $errors->first('code') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="currency_name">Currency Name <b style="color: red">*</b></label>
                                                            <input type="text" maxlength="15" placeholder="Enter Currency Name" name="currency_name" id="currency_name" class="form-control" value="{{ $country_list->currency_name }}" required/>
                                                            @if ($errors->has('currency_name'))
                                                            <span class="help-block">
                                                                <strong><i class="fa fa-warning"></i> {{ $errors->first('currency_name') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="currency_symbol">Currency Symbol <b style="color: red">*</b></label>
                                                            <input type="text" maxlength="15" placeholder="Enter Currency Symbol" name="currency_symbol" id="currency_symbol" class="form-control" value="{{ $country_list->currency_symbol }}" required/>
                                                            @if ($errors->has('currency_symbol'))
                                                            <span class="help-block">
                                                                <strong><i class="fa fa-warning"></i> {{ $errors->first('currency_symbol') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="status">Status <b style="color: red">*</b></label>
                                                            <select class="form-control select2" name="status" id="status" required>
                                                                <option value="Active"{{ ($country_list->status == 'Active') ? 'selected' : '' }}>Active</option>
                                                                <option value="Inactive"{{ ($country_list->status == 'Inactive') ? 'selected' : '' }}>Inactive</option>
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
            @include('backend.layout.footer')
        </div>
        @include('backend.layout.footer_script')

        <script type="text/javascript">
            $("#country_active").addClass("active");
            $("#country_active").parent().parent().addClass("treeview active");
            $("#country_active").parent().addClass("in");
        </script>
    </body>
</html>
