<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Aashepashe | Portal Users</title>
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
                                    <div class="panel-heading panel-style"><i class="fa fa-clone"></i> Portal Users [Admin & Employee]</div>
                                    <div class="panel-body">
                                        @include('backend.layout.message')
                                        <div class="row">
                                            <div class="col-md-12 table-responsive">
                                                <table id="table" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Phone</th>
                                                            <th>Image</th>
                                                            <th>Type</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($data_list AS $data)
                                                        <tr>
                                                            <td>
                                                                {{ $data->name }}
                                                                @if($data->is_logged == 'Yes')
                                                                <br>
                                                                <small style="color: darkred;font-weight: bold">Logged in</small>
                                                                @endif
                                                            </td>
                                                            <td>{{ $data->email }}</td>
                                                            <td>{{ $data->phone }}</td>
                                                            <td>
                                                                @if(!empty($data->avatar))
                                                                <img src="{{ asset('upload/admin/avatar/'.$data->avatar) }}" alt="Image" class="img img-circle img-responsive" style="width: 40px;height: 30px"/>
                                                                @else
                                                                <img src="{{ asset('frontend/images/default.jpg') }}" alt="Image" class="img img-circle img-responsive" style="width: 40px;height: 30px"/>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if($data->type == 'Admin')
                                                                <span class="label label-success">{{ $data->type }}</span>
                                                                @else
                                                                <span class="label label-warning">{{ $data->type }}</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if($data->status == 'Active')
                                                                <span class="label label-primary">{{ $data->status }}</span>
                                                                @else
                                                                <span class="label label-warning">{{ $data->status }}</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <a class="action_style" href="{{ URL::to('portal/admin/edit/'.$data->admin_id) }}"><i class="fa fa-edit"></i> Edit</a>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td class="text-center" colspan="6"></td>
                                                            <td class="text-left" colspan="1">
                                                                <a href="{{ URL::to('portal/admin/add') }}">
                                                                    <button class="btn btn-primary btn-xs">
                                                                        <i class="fa fa-plus"></i>&nbsp;Add New
                                                                    </button>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
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
        <script>
            $(document).ready(function () {
                $('#table').DataTable({
                    "aaSorting": [[0, "asc"]]
                });
            });
        </script>
        <script type="text/javascript">
            $("#admin_active").addClass("active");
            $("#admin_active").parent().parent().addClass("treeview active");
            $("#admin_active").parent().addClass("in");
        </script>
    </body>
</html>
