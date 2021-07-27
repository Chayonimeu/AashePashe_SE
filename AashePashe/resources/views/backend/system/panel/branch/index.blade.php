<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Aashepashe | Branch List</title>
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
                                    <div class="panel-heading panel-style"><i class="fa fa-clone"></i> Branch List</div>
                                    <div class="panel-body">
                                        @include('backend.layout.panel.message')
                                        <div class="row">
                                            <div class="col-md-12 table-responsive">
                                                <table id="table" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Area</th>
                                                            <th>Contact Info</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($data_list AS $data)
                                                        <tr>
                                                            <td>{{ $data->name }}</td>
                                                            <td>
                                                                <b>Address:</b> {{ $data->address }}<br>
                                                                @if($data->sub_area_id != '')
                                                                <b>Sub Area:</b> {{ $data->get_branch_sub_area->name }}<br>
                                                                @endif
                                                                <b>City:</b> {{ $data->get_branch_city->name }}<br>
                                                                <b>Country:</b> {{ $data->get_branch_country->name }}
                                                            </td>
                                                            <td>
                                                                @if($data->contact_name != '')
                                                                <i class="fa fa-user"></i> {{ $data->contact_name }}<br>
                                                                @endif
                                                                @if($data->contact_email != '')
                                                                <i class="fa fa-envelope"></i> {{ $data->contact_email }}<br>
                                                                @endif
                                                                @if($data->contact_phone != '')
                                                                <i class="fa fa-phone"></i> {{ $data->contact_phone }}
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
                                                                <a href="{{ URL::to('portal/merchant/branch/edit/'.$data->branch_id) }}" class="action_style"><i class="fa fa-edit"></i> Edit</a>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td class="text-center" colspan="4"></td>
                                                            <td class="text-left" colspan="1">
                                                                <a href="{{ URL::to('portal/merchant/branch/add') }}">
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
            @include('backend.layout.panel.footer')
        </div>
        @include('backend.layout.panel.footer_script')
        <script>
            $(document).ready(function () {
                $('#table').DataTable({
                    "aaSorting": [[0, "asc"]]
                });
            });
        </script>
        <script type="text/javascript">
            $("#branch_active").addClass("active");
            $("#branch_active").parent().parent().addClass("treeview active");
            $("#branch_active").parent().addClass("in");
        </script>
    </body>
</html>
