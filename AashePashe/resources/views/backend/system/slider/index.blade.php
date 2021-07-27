<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Aashepashe | Slider</title>
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
                                    <div class="panel-heading panel-style">
                                        <i class="fa fa-clone"></i> Slider
                                        <a href="{{ URL::to('portal/slider/add') }}" class="pull-right"><i class="fa fa-plus-circle"></i> Add New</a>
                                    </div>
                                    <div class="panel-body">
                                        @include('backend.layout.message')
                                        @if(count($data_list))
                                        @foreach($data_list AS $slider)
                                        <div class="col-md-4" style="border: 1px solid #f3f3f4;height: 300px;margin-bottom: 5px">
                                            <img src="{{ url('upload/slider/'.$slider->image) }}" alt="slider image" class="img img-responsive" style="height: 150px;width: 100%;margin-top: 10px"/><br>
                                            @if($slider->details != '')
                                            <p style="margin-top: 5px;">{{ $slider->details }}</p>
                                            <p>&nbsp;</p>
                                            @else
                                            <p style="margin-top: 5px">&nbsp;</p>
                                            @endif
                                            @if($slider->status == 'Active')
                                            <span class="label label-primary">{{ $slider->status }}</span>
                                            @else
                                            <span class="label label-warning">{{ $slider->status }}</span>
                                            @endif
                                            <a class="action_style" href="{{ URL::to('portal/slider/edit/'.$slider->slider_id) }}"><i class="fa fa-edit"></i> Edit</a>
                                            <a class="action_style" role="button" data-toggle="modal" data-target="#delete_slider{{ $slider->slider_id }}"><i class="fa fa-trash-o"></i> Delete</a>
                                            <!-- Delete slider -->
                                            <div id="delete_slider{{ $slider->slider_id }}" class="modal fade" role="dialog">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <form method="POST" action="{{ URL::to('portal/slider/delete') }}">
                                                            {{ csrf_field() }}
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <input type="hidden" name="slider_id" value="{{ $slider->slider_id }}" />
                                                                <h4 class="modal-title" style="color: #f8ac59;"><i class="fa fa-warning"></i> Warning</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Are you sure you want to delete this slider? Click "Yes" to delete.</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary" name="btn"><i class="fa fa-check"></i> Yes</button>
                                                                <button type="button" class="btn btn-primary btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Delete slider -->
                                        </div>
                                        @endforeach
                                        @else
                                        <div class="panel panel-default" style="margin-bottom: 5px">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a href="javascript:void(0)">No data found</a>
                                                </h4>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="clearfix"></div>
                                        <span class="pull-right">{{ $data_list->links() }}</span>
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
            $("#slider_active").addClass("active");
            $("#slider_active").parent().parent().addClass("treeview active");
            $("#slider_active").parent().addClass("in");
        </script>
    </body>
</html>
