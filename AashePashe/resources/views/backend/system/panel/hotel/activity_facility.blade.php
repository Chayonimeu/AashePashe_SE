<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Aashepashe | Hotel Activity Facilities</title>
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
                                        <i class="fa fa-clone"></i> Hotel Activity Facilities For {{ $data_list->name }}
                                    </div>
                                    <div class="panel-body">
                                        @include('backend.layout.panel.message')
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form role="form" class="" method="POST" action="{{ URL::to('portal/merchant/hotel/activity/facilities/store') }}" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="hotel_id" value="{{ $data_list->hotel_info_id }}" />
                                                    @foreach($activity_facility AS $facility)
                                                    <div class="col-md-4">
                                                        @php $activity_facility_check = App\ActivityWiseFacilityModel::where('hotel_id', $data_list->hotel_info_id)->where('facility_id', $facility->activity_facility_id)->select('facility_id')->first(); @endphp
                                                       
                                                        @if($activity_facility_check['facility_id'] == $facility->activity_facility_id)
                                                        <input type="checkbox" checked name="facility_id[]" value="{{ $facility->activity_facility_id }}" />&nbsp; {{ $facility->name }}
                                                        @else
                                                        <input type="checkbox" name="facility_id[]" value="{{ $facility->activity_facility_id }}" />&nbsp; {{ $facility->name }}
                                                        @endif
                                                    </div>
                                                    @endforeach
                                                    <div class="col-md-12" style="margin-top: 10px">
                                                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Submit</button>
                                                    </div>
                                                </form>
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
