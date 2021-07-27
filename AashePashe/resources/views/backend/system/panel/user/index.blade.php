<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Aashepashe | Merchant User List</title>
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
                                    <div class="panel-heading panel-style"><i class="fa fa-clone"></i> User List</div>
                                    <div class="panel-body">
                                        @include('backend.layout.panel.message')
                                        <div class="row">
                                            <div class="col-md-12 table-responsive">
                                                <table id="table" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Phone</th>
                                                            <th>Image</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($data_list AS $data)
                                                        <tr>
                                                            <td>{{ $data->name }}</td>
                                                            <td>{{ $data->email }}</td>
                                                            <td>{{ $data->country_code }}{{ $data->phone }}</td>
                                                            <td>
                                                                @if(!empty($data->avatar))
                                                                <img src="{{ asset('upload/merchant/avatar/'.$data->avatar) }}" alt="Image" class="img img-circle img-responsive" style="width: 40px;height: 30px"/>
                                                                @else
                                                                <img src="{{ asset('backend/images/default.jpg') }}" alt="Image" class="img img-circle img-responsive" style="width: 40px;height: 30px"/>
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
                                                                <a href="#"><i class="fa fa-edit"></i> Edit</a><br>
                                                                <a href="javascript:void(0)" data-toggle="modal" data-target="#assign{{ $data->merchant_id }}"><i class="fa fa-exchange"></i> Assign Branch</a>
                                                                <!-- Assign -->
                                                                <div id="assign{{ $data->merchant_id }}" class="modal fade" role="dialog">
                                                                    <div class="modal-dialog modal-md">
                                                                        <div class="modal-content">
                                                                            <form method="POST" enctype="multipart/form-data" action="{{ URL::to('portal/merchant/assign') }}">
                                                                                {{ csrf_field() }}
                                                                                <div class="modal-header">
                                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                    <input type="hidden" name="merchant_id" value="{{ $data->merchant_id }}" />
                                                                                    <h4 class="modal-title">Assign Branch To {{ $data->name }}</h4>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    @if(count($branch_list) > 0)
                                                                                    <div class="form-group">
                                                                                        <label for="branch_id">Choose Branch <b style="color: red">*</b></label><br>
                                                                                        @foreach($branch_list AS $branch)
                                                                                        @php $branch_check = App\BranchWiseUserModel::where('merchant_id', $data->merchant_id)->where('branch_id', $branch->branch_id)->select('branch_id')->first(); @endphp
                                                                                        @if($branch_check['branch_id'] == $branch->branch_id)
                                                                                        <input type="checkbox" checked name="branch_id[]" value="{{ $branch->branch_id }}" />&nbsp;{{ $branch->name }}<br>
                                                                                        @else
                                                                                        <input type="checkbox" name="branch_id[]" value="{{ $branch->branch_id }}" />&nbsp;{{ $branch->name }}<br>
                                                                                        @endif
                                                                                        @endforeach
                                                                                    </div>
                                                                                    @else
                                                                                    <div class="callout callout-danger">
                                                                                        <h4>Warning!</h4>
                                                                                        <p>No branch found. Please add branch first</p>
                                                                                    </div>
                                                                                    @endif
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Submit</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Assign -->
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td class="text-center" colspan="5"></td>
                                                            <td class="text-left" colspan="1">
                                                                <a href="{{ URL::to('portal/merchant/user/add') }}">
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
            $("#merchant_user_active").addClass("active");
            $("#merchant_user_active").parent().parent().addClass("treeview active");
            $("#merchant_user_active").parent().addClass("in");
        </script>
    </body>
</html>
