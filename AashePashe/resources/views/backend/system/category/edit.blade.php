<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Aashepashe | Edit Business Type (Category)</title>
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
                                    <div class="panel-heading panel-style"><i class="fa fa-clone"></i> Edit Category
                                        <a href="{{ url()->previous() }}" class="pull-right"><i class="fa fa-arrow-circle-left"></i> Go Back</a>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-6">
                                                    <form role="form" class="" method="POST" action="{{ URL::to('portal/category/update') }}" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="category_id" value="{{ $data_list->category_id }}" />

                                                        <div class="form-group">
                                                            <label for="name">Name <b style="color: red">*</b></label>
                                                            <input type="text" maxlength="100" placeholder="Enter Name" name="name" id="name" class="form-control" value="{{ $data_list->name }}" required/>
                                                            @if ($errors->has('name'))
                                                            <span class="help-block">
                                                                <strong><i class="fa fa-warning"></i> {{ $errors->first('name') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="type_name">Used For <b style="color: red">*</b></label>
                                                            <select class="form-control select2" name="type_name" id="type_name" required>
                                                                <option value="">Select Type</option>
                                                                @foreach($type_list AS $data)
                                                                <option value="{{ $data->name }}"{{ ($data_list->type_name == $data->name) ? 'selected' : '' }}>{{ $data->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @if ($errors->has('type_name'))
                                                            <span class="help-block">
                                                                <strong><i class="fa fa-warning"></i> {{ $errors->first('type_name') }}</strong>
                                                            </span>
                                                            @endif
                                                            <small style="color: darkred"><i class="fa fa-info-circle"></i> This will operate the redirection of merchant account panel</small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="status">Status <b style="color: red">*</b></label>
                                                            <select class="form-control select2" name="status" id="status" required>
                                                                <option value="Active"{{ ($data_list->status == 'Active') ? 'selected' : '' }}>Active</option>
                                                                <option value="Inactive"{{ ($data_list->status == 'Inactive') ? 'selected' : '' }}>Inactive</option>
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
            $("#category_active").addClass("active");
            $("#category_active").parent().parent().addClass("treeview active");
            $("#category_active").parent().addClass("in");
        </script>
    </body>
</html>
