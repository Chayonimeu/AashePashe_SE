<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Aashepashe | Merchant Details</title>
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
                                    <div class="panel-heading panel-style"><i class="fa fa-clone"></i> Merchant Details [{{ $data_list->name }}]</div>
                                    <div class="panel-body">
                                        @include('backend.layout.message')
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="box box-primary">
                                                    <div class="box-body box-profile">
                                                        <center>
                                                            @if ($data_list->avatar == '')
                                                            <img src="{{ asset('frontend/images/default.jpg') }}" alt="Image" class="profile-user-img img-responsive img-circle" style="height: 80px"/>
                                                            @else
                                                            <img src="{{ asset('upload/merchant/avatar/'.$data_list->avatar) }}" class="profile-user-img img-responsive img-circle" style="height: 80px" alt="Image"/>
                                                            @endif
                                                            <h3 class="profile-username text-center">{{ $data_list->name }}</h3>
                                                            <small>Member Since - {{ $data_list->created_at }}</small>
                                                        </center>
                                                        <ul class="list-group list-group-unbordered">
                                                            <li class="list-group-item">
                                                                <small><i class="fa fa-envelope-square"></i> Owner Email</small><br>
                                                                <b>{{ $data_list->email }}</b>
                                                            </li>
                                                            <li class="list-group-item">
                                                                <small><i class="fa fa-phone-square"></i> Owner Phone</small><br>
                                                                <b>{{ $data_list->phone }}</b>
                                                            </li>
                                                            <li class="list-group-item">
                                                                <small><i class="fa fa-home"></i> Company Name</small><br>
                                                                <b>{{ $data_list->company_name }}</b>
                                                            </li>
                                                            <li class="list-group-item">
                                                                <small><i class="fa fa-home"></i> Company Logo</small><br>
                                                                @if ($data_list->company_logo == '')
                                                                <img src="{{ asset('frontend/images/default.jpg') }}" alt="Image" class="img-responsive img-circle" style="height: 80px"/>
                                                                @else
                                                                <img src="{{ asset('upload/merchant/logo/'.$data_list->company_logo) }}" class="img-responsive img-circle" style="height: 80px" alt="Image"/>
                                                                @endif
                                                            </li>
                                                            <li class="list-group-item">
                                                                <small><i class="fa fa-filter"></i> Business Type</small><br>
                                                                <b>{{ $data_list->get_business_type->name }}</b>
                                                            </li>
                                                            <li class="list-group-item">
                                                                <small><i class="fa fa-map-marker"></i> Company Address</small><br>
                                                                <b>{{ $data_list->company_address }}</b>
                                                            </li>
                                                        </ul>
                                                        @if($data_list->status == 'Inactive')
                                                        <a href="javascript:void(0)" role="button" data-toggle="modal" data-target="#activate{{ $data_list->merchant_id }}" class="btn btn-primary btn-block btn-xs"><b><i class="fa fa-check"></i> Activate Account</b></a>
                                                        @else
                                                        <a href="javascript:void(0)" role="button" data-toggle="modal" data-target="#activate{{ $data_list->merchant_id }}" class="btn btn-danger btn-block btn-xs"><b><i class="fa fa-close"></i> Deactivate Account</b></a>
                                                        @endif
                                                        <!-- Activate / Inactivate Merchant -->
                                                        <div id="activate{{ $data_list->merchant_id }}" class="modal fade" role="dialog">
                                                            <div class="modal-dialog modal-sm">
                                                                <div class="modal-content">
                                                                    <form method="POST" action="{{ URL::to('portal/merchant/activate') }}">
                                                                        {{ csrf_field() }}
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                            <input type="hidden" name="merchant_id" value="{{ $data_list->merchant_id }}" />
                                                                            <h4 class="modal-title" style="color: #f8ac59;"><i class="fa fa-warning"></i> Warning</h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            @if($data_list->status == 'Inactive')
                                                                            <p>Are you sure you want to activate this merchant? Click "Yes" to activate account.</p>
                                                                            <input type="hidden" name="action_value" value="Active" />
                                                                            @else
                                                                            <p>Are you sure you want to deactivate this merchant? Click "Yes" to deactivate account.</p>
                                                                            <input type="hidden" name="action_value" value="Inactive" />
                                                                            @endif
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" class="btn btn-primary" name="btn"><i class="fa fa-check"></i> Yes</button>
                                                                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Activate / Inactivate Merchant -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="nav-tabs-custom">
                                                    <ul class="nav nav-tabs">
                                                        <li class="active"><a href="">Branch Info</a></li>
                                                        <li><a href="">Send Message</a></li>
                                                        <li><a href="">Recent Activity</a></li>
                                                    </ul>
                                                    <div class="tab-content">
                                                        <div class="active tab-pane">
                                                            <div class="row">
                                                                <div class="col-md-12 table-responsive">
                                                                    <table id="table" class="table table-bordered table-striped">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Name</th>
                                                                                <th>Area</th>
                                                                                <th>Contacts</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach($branch_list AS $branch)
                                                                            <tr>
                                                                                <td>
                                                                                    {{ $branch->name }}<br>
                                                                                    @if($branch->status == 'Active')
                                                                                    <b>Status:</b> <span class="label label-primary">{{ $branch->status }}</span>
                                                                                    @else
                                                                                    <b>Status:</b> <span class="label label-warning">{{ $branch->status }}</span>
                                                                                    @endif
                                                                                </td>
                                                                                <td>
                                                                                    <b>Address: </b>{{ $branch->address }}<br>
                                                                                    @if($branch->sub_area_id != '')
                                                                                    <b>Sub Area: </b>{{ $branch->get_branch_sub_area->name }}<br>
                                                                                    @endif
                                                                                    <b>City: </b>{{ $branch->get_branch_city->name }}<br>
                                                                                    <b>Country: </b>{{ $branch->get_branch_country->name }}
                                                                                </td>
                                                                                <td>
                                                                                    @if($branch->contact_name != '')
                                                                                    <i class="fa fa-user"></i> {{ $branch->contact_name }}<br>
                                                                                    @endif
                                                                                    @if($branch->contact_email != '')
                                                                                    <i class="fa fa-envelope"></i> {{ $branch->contact_email }}<br>
                                                                                    @endif
                                                                                    @if($branch->contact_phone != '')
                                                                                    <i class="fa fa-phone"></i> {{ $branch->contact_phone }}
                                                                                    @endif
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
