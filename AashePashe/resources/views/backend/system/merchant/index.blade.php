<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Aashepashe | Merchant Users</title>
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
                                    <div class="panel-heading panel-style"><i class="fa fa-clone"></i> Merchant Users</div>
                                    <div class="panel-body">
                                        @include('backend.layout.message')
                                        <div class="row">
                                            <div class="col-md-12 table-responsive">
                                                <table id="table" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Basic Information</th>
                                                            <th>Company Information</th>
                                                            <th>Verified?</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($data_list AS $data)
                                                        <tr>
                                                            <td>
                                                                {{ $data->name }}<br>
                                                                <i class="fa fa-envelope"></i> {{ $data->email }}<br>
                                                                <i class="fa fa-phone"></i> {{ $data->country_code }}{{ $data->phone }}
                                                            </td>
                                                            <td>
                                                                <i class="fa fa-home"></i> {{ $data->company_name }}<br>
                                                                <i class="fa fa-filter"></i> {{ $data->get_business_type->name }}<br>
                                                                <i class="fa fa-map-marker"></i> {{ $data->company_address }}
                                                            </td>
                                                            <td>{{ $data->is_verified }}</td>
                                                            <td>
                                                                @if($data->status == 'Active')
                                                                <span class="label label-primary">{{ $data->status }}</span>
                                                                @else
                                                                <span class="label label-warning">{{ $data->status }}</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <a class="action_style" href="{{ URL::to('portal/merchant/details/'.$data->merchant_id) }}"><i class="fa fa-eye"></i> View Details</a><br>
                                                                <a class="action_style" href=""><i class="fa fa-user-plus"></i> Branch Users</a>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
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
            $("#merchant_active").addClass("active");
            $("#merchant_active").parent().parent().addClass("treeview active");
            $("#merchant_active").parent().addClass("in");
        </script>
    </body>
</html>
