<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Aashepashe | Portal Users | Edit User</title>
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
                                    <div class="panel-heading panel-style"><i class="fa fa-clone"></i> Edit Portal User</div>
                                    <div class="panel-body">
                                        @include('backend.layout.message')
                                        <div class="row">
                                            <div class="col-md-6">
                                                <form role="form" class="" method="POST" action="{{ URL::to('portal/admin/update') }}" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="admin_id" value="{{ $data_list->admin_id }}" />
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
                                                        <label for="email">Email <b style="color: red">*</b></label>
                                                        <input type="email" maxlength="100" placeholder="Enter Email" name="email" id="email" class="form-control" value="{{ $data_list->email }}" required/>
                                                        @if ($errors->has('email'))
                                                        <span class="help-block">
                                                            <strong><i class="fa fa-warning"></i> {{ $errors->first('email') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="phone">Phone <b style="color: red">*</b></label>
                                                        <input type="text" placeholder="Enter Phone" name="phone" id="phone" class="form-control" value="{{ $data_list->phone }}" required />
                                                        @if ($errors->has('phone'))
                                                        <span class="help-block">
                                                            <strong><i class="fa fa-warning"></i> {{ $errors->first('phone') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="avatar">Image</label>
                                                        <input type="file" name="avatar" id="avatar" class="form-control"/>
                                                        @if ($errors->has('avatar'))
                                                        <span class="help-block">
                                                            <strong><i class="fa fa-warning"></i> {{ $errors->first('avatar') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="type">Type <b style="color: red">*</b></label>
                                                        <select class="form-control select2" name="type" id="type" required>
                                                            <option value="Admin"{{ ($data_list->type == 'Admin') ? 'selected' : '' }}>Admin</option>
                                                            <option value="Employee"{{ ($data_list->type == 'Employee') ? 'selected' : '' }}>Employee</option>
                                                        </select>
                                                        @if ($errors->has('type'))
                                                        <span class="help-block">
                                                            <strong><i class="fa fa-warning"></i> {{ $errors->first('type') }}</strong>
                                                        </span>
                                                        @endif
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
                </section>
            </div>
            @include('backend.layout.footer')
        </div>
        @include('backend.layout.footer_script')
        <script type="text/javascript">
            $("#admin_active").addClass("active");
            $("#admin_active").parent().parent().addClass("treeview active");
            $("#admin_active").parent().addClass("in");
        </script>
    </body>
</html>
