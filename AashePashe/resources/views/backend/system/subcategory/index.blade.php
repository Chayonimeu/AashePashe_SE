<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Aashepashe | Business Type (Sub Category)</title>
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
                                    <div class="panel-heading panel-style"><i class="fa fa-clone"></i> Business Type (Sub Category) For <span style="color: #1E4770">{{ $category_info->name }}</span>
                                        <a href="{{ url()->previous() }}" class="pull-right"><i class="fa fa-arrow-circle-left"></i> Go Back</a>
                                    </div>
                                    <div class="panel-body">
                                        @include('backend.layout.message')
                                        <div class="row">
                                            <div class="col-md-12 table-responsive">
                                                <table id="table" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($data_list AS $data)
                                                        <tr>
                                                            <td>{{ $data->name }}</td>
                                                            <td>
                                                                @if($data->status == 'Active')
                                                                <span class="label label-primary">{{ $data->status }}</span>
                                                                @else
                                                                <span class="label label-warning">{{ $data->status }}</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <a class="action_style" href="{{ URL::to('portal/subcategory/edit/'.$data->sub_category_id) }}"><i class="fa fa-edit"></i> Edit</a><br>
                                                                <a class="action_style" href="javascript:void(0)" data-toggle="modal" data-target="#delete_sub_category{{ $data->sub_category_id }}"><i class="fa fa-trash-o"></i> Delete</a>
                                                                <!-- Delete -->
                                                                <div id="delete_sub_category{{ $data->sub_category_id }}" class="modal fade" role="dialog">
                                                                    <div class="modal-dialog modal-sm">
                                                                        <div class="modal-content">
                                                                            <form method="POST" action="{{ URL::to('portal/subcategory/delete') }}">
                                                                                {{ csrf_field() }}
                                                                                <div class="modal-header">
                                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                    <input type="hidden" name="sub_category_id" value="{{ $data->sub_category_id }}" />
                                                                                    <h4 class="modal-title" style="color: #f8ac59;"><i class="fa fa-warning"></i> Warning</h4>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <p>Are you sure want to delete? Click "Yes" to delete.</p>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="submit" class="btn btn-primary" name="btn"><i class="fa fa-check"></i> Yes</button>
                                                                                    <button type="button" class="btn btn-primary btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Delete -->
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td class="text-center" colspan="2"></td>
                                                            <td class="text-left" colspan="1">
                                                                <a href="{{ URL::to('portal/subcategory/add/'.$category_info->category_id) }}">
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
            $("#category_active").addClass("active");
            $("#category_active").parent().parent().addClass("treeview active");
            $("#category_active").parent().addClass("in");
        </script>
    </body>
</html>
