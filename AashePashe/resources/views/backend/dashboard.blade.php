<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Aashepashe | Dashboard</title>
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
                        <div class="col-lg-3 col-xs-6">
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>150</h3>
                                    <p>Total Orders</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-cart-plus"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xs-6">
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>100</h3>
                                    <p>Total Merchants</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-user-md"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xs-6">
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>50</h3>
                                    <p>Total Users</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-user-secret"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xs-6">
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>65</h3>
                                    <p>Unique Visitors</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-bars"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="box box-primary" style="margin-top: 10px">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-list"></i> Recent Orders</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="table-responsive">
                                        <table class="table no-margin">
                                            <thead>
                                                <tr>
                                                    <th>Order ID</th>
                                                    <th>Total</th>
                                                    <th>Created On</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><a href="javascript:void(0)">AP123456789</a></td>
                                                    <td>300 ৳</td>
                                                    <td>30 Mins Before</td>
                                                </tr>
                                                <tr>
                                                    <td><a href="javascript:void(0)">AP987654321</a></td>
                                                    <td>150 ৳</td>
                                                    <td>1 Hour Before</td>
                                                </tr>
                                                <tr>
                                                    <td><a href="javascript:void(0)">AP568940321</a></td>
                                                    <td>200 ৳</td>
                                                    <td>1 Day Before</td>
                                                </tr>
                                                <tr>
                                                    <td><a href="javascript:void(0)">AP564890321</a></td>
                                                    <td>200 ৳</td>
                                                    <td>31/03/2019</td>
                                                </tr>
                                                <tr>
                                                    <td><a href="javascript:void(0)">AP560040321</a></td>
                                                    <td>200 ৳</td>
                                                    <td>30/03/2019</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="box box-primary" style="margin-top: 10px">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-user-md"></i> Recent Registered Merchants</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="table-responsive">
                                        <table class="table no-margin">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Phone</th>
                                                    <th>Email</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><a href="javascript:void(0)">Abdur Rahman</a></td>
                                                    <td>01812878956</td>
                                                    <td>arahman@gmail.com</td>
                                                </tr>
                                                <tr>
                                                    <td><a href="javascript:void(0)">AKM Salam</a></td>
                                                    <td>01788232809</td>
                                                    <td>akmsalam11@yahoo.com</td>
                                                </tr>
                                                <tr>
                                                    <td><a href="javascript:void(0)">Khairul Islam</a></td>
                                                    <td>01700232809</td>
                                                    <td>arkhairul@yahoo.com</td>
                                                </tr>
                                                <tr>
                                                    <td><a href="javascript:void(0)">Md Shakib</a></td>
                                                    <td>01988200809</td>
                                                    <td>mdshakib@outlook.com</td>
                                                </tr>
                                                <tr>
                                                    <td><a href="javascript:void(0)">Masuduzzaman</a></td>
                                                    <td>01557232498</td>
                                                    <td>bdmasud@gmail.com</td>
                                                </tr>
                                            </tbody>
                                        </table>
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
            $("#dashboard_active").addClass("active");
            $("#dashboard_active").parent().parent().addClass("treeview active");
            $("#dashboard_active").parent().addClass("in");
        </script>
    </body>
</html>
