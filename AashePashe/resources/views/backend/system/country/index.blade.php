<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Aashepashe | Business Area (Country)</title>
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
                                    <div class="panel-heading panel-style"><i class="fa fa-clone"></i> Business Area (Country)</div>
                                    <div class="panel-body">
                                        @include('backend.layout.message')
                                        <div class="row">
                                            <div class="col-md-12 table-responsive">
                                                <table id="table" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Short Name</th>
                                                            <th>Calling Code</th>
                                                            <th>Currency</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($country_list AS $data)
                                                        <tr>
                                                            <td>{{ $data->name }}</td>
                                                            <td>{{ $data->short_name }}</td>
                                                            <td>{{ $data->code }}</td>
                                                            <td>{{ $data->currency_name }}&nbsp;{{ $data->currency_symbol }}</td>
                                                            <td>
                                                                @if($data->status == 'Active')
                                                                <span class="label label-primary">{{ $data->status }}</span>
                                                                @else
                                                                <span class="label label-warning">{{ $data->status }}</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <a class="action_style" href="{{ URL::to('portal/country/edit/'.$data->country_id) }}"><i class="fa fa-edit"></i> Edit Country</a><br>
                                                                <a class="action_style" href="{{ URL::to('portal/city/'.$data->country_id) }}"><i class="fa fa-list"></i> Business Cities</a>
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
            $("#country_active").addClass("active");
            $("#country_active").parent().parent().addClass("treeview active");
            $("#country_active").parent().addClass("in");
        </script>
    </body>
</html>
