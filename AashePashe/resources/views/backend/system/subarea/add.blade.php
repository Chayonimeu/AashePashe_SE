<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Aashepashe | Add New Sub Area Under {{ $city_info->name }} City</title>
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
                                    <div class="panel-heading panel-style"><i class="fa fa-clone"></i> Add New Sub Area Under {{ $city_info->name }} City
                                        <a href="{{ url()->previous() }}" class="pull-right"><i class="fa fa-arrow-circle-left"></i> Go Back</a>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-6">
                                                    <form role="form" class="" method="POST" action="{{ URL::to('portal/subarea/store') }}" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="city_id" value="{{ $city_info->city_id }}" />
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
                                                            <label for="latitude">Latitude</label>
                                                            <input type="text" maxlength="50" placeholder="Enter Latitude" name="latitude" id="latitude" class="form-control" value="{{ old('latitude') }}" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="longitude">Longitude</label>
                                                            <input type="text" maxlength="50" placeholder="Enter Longitude" name="longitude" id="longitude" class="form-control" value="{{ old('longitude') }}" />
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
