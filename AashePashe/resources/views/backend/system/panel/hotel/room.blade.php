<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Aashepashe | Hotel Rooms</title>
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
                                    <div class="panel-heading panel-style"> 
                                        <i class="fa fa-clone"></i> Hotel Rooms For {{ $data_list->name }}
                                        <a href="{{ URL::to('portal/merchant/hotel/rooms/add/'. $data_list->hotel_info_id) }}" class="pull-right" style="font-size: 12px;border: 1px solid #48a0d6;border-radius: 5px;padding: 3px 10px 3px 10px;color: #48a0d6"><i class="fa fa-plus"></i> Add New</a>
                                    </div>
                                    <div class="panel-body">
                                        @include('backend.layout.panel.message')
                                        <div class="row">
                                            <div class="col-md-12">
                                                @if(count($room_list))
                                                @foreach($room_list AS $room)
                                                <div class="col-md-3">
                                                    <img style="height: 150px;width: 100%" src="{{ url('upload/hotel/room/'.$room->image) }}" alt="Image" class="img img-responsive img-thumbnail">
                                                    <h5><b>{{ $room->get_room_type->name }}</b></h5>
                                                    <h6><b>Standard Occupancy: {{ $room->occupancy }}</b></h6>
                                                    <h6><b>No of Rooms: {{ $room->total_room }}</b></h6>
                                                    <a href="#"><i class="fa fa-edit"></i>Edit</a>&nbsp;
                                                    <a href="#"><i class="fa fa-trash"></i>Delete</a>
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
        <script type="text/javascript">
            $("#hotel_active").addClass("active");
            $("#hotel_active").parent().parent().addClass("treeview active");
            $("#hotel_active").parent().addClass("in");
        </script>
    </body>
</html>
