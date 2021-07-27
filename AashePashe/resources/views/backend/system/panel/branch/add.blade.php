<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Aashepashe | Add New Branch</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        @include('backend.layout.panel.header_script')
        <!--CSRF token-->
        <meta name="csrf-token" content="{{ csrf_token() }}">
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
                                    <div class="panel-heading panel-style"><i class="fa fa-clone"></i> Add New Branch
                                        <a href="{{ url()->previous() }}" class="pull-right"><i class="fa fa-arrow-circle-left"></i> Go Back</a>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-6">
                                                    <form role="form" class="" method="POST" action="{{ URL::to('portal/merchant/branch/store') }}" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <div class="form-group">
                                                            <label for="name">Name <b style="color: red">*</b></label>
                                                            <input type="text" placeholder="Enter Branch Name" name="name" id="name" class="form-control" value="{{ old('name') }}" required/>
                                                            @if ($errors->has('name'))
                                                            <span class="help-block">
                                                                <strong><i class="fa fa-warning"></i> {{ $errors->first('name') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="country_id">Country <b style="color: red">*</b></label>
                                                            <select class="form-control" name="country_id" id="country_id" required="required" onchange="javascript:get_city(this.value);">
                                                                <option value="">Select Country</option>
                                                                @foreach($country_list AS $country)
                                                                <option value="{{ $country->country_id }}"{{ (old('country_id') == $country->country_id) ? 'selected' : '' }}>{{ $country->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @if ($errors->has('country_id'))
                                                            <span class="help-block">
                                                                <strong><i class="fa fa-warning"></i> {{ $errors->first('country_id') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="city_id">City <b style="color: red">*</b></label>
                                                            <span id="city_div">
                                                                <select class="form-control" name="city_id" id="city_id" required="required" onchange="javascript:get_sub_area(this.value);">
                                                                    <option value="">Select City</option>
                                                                </select>
                                                            </span>
                                                            @if ($errors->has('city_id'))
                                                            <span class="help-block">
                                                                <strong><i class="fa fa-warning"></i> {{ $errors->first('city_id') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="sub_area_id">Sub Area</label>
                                                            <span id="sub_area_div">
                                                                <select class="form-control" name="sub_area_id" id="sub_area_id">
                                                                    <option value="">Select Sub Area</option>
                                                                </select>
                                                            </span>
                                                            @if ($errors->has('sub_area_id'))
                                                            <span class="help-block">
                                                                <strong><i class="fa fa-warning"></i> {{ $errors->first('sub_area_id') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="address">Address <b style="color: red">*</b></label>
                                                            <textarea class="form-control" id="address" name="address" required="required">{{ old('address') }}</textarea>
                                                            @if ($errors->has('address'))
                                                            <span class="help-block">
                                                                <strong><i class="fa fa-warning"></i> {{ $errors->first('address') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="contact_name">Contact Name</label>
                                                            <input type="text" placeholder="Enter Contact Name" name="contact_name" id="contact_name" class="form-control" value="{{ old('contact_name') }}"/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="contact_email">Contact Email</label>
                                                            <input type="email" placeholder="Enter Contact Email" name="contact_email" id="contact_email" class="form-control" value="{{ old('contact_email') }}"/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="contact_phone">Contact Phone</label>
                                                            <input type="text" placeholder="Enter Contact Phone" name="contact_phone" id="contact_phone" class="form-control" value="{{ old('contact_phone') }}"/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="status">Status <b style="color: red">*</b></label>
                                                            <select class="form-control" name="status" id="status" required>
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
            $("#branch_active").addClass("active");
            $("#branch_active").parent().parent().addClass("treeview active");
            $("#branch_active").parent().addClass("in");
        </script>
    </body>
</html>
