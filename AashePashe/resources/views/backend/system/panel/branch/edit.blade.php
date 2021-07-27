<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Aashepashe | Edit Branch</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        @include('backend.layout.headerScript')
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
                                    <div class="panel-heading panel-style"><i class="fa fa-clone"></i> Edit District</div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-6">
                                                    <form role="form" class="" method="POST" action="{{ URL::to('portal/district/update') }}" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="districtId" value="{{ $dataList->districtId }}" />
                                                        <div class="form-group">
                                                            <label for="districtDivisionId">Division <b style="color: red">*</b></label>
                                                            <select class="form-control select2" name="districtDivisionId" id="districtDivisionId" required>
                                                                <option value="">Select Division</option>
                                                                @foreach($divisionList AS $division)
                                                                <option value="{{ $division->divisionId }}"{{ ($dataList->districtDivisionId == $division->divisionId) ? 'selected' : '' }}>{{ $division->divisionName }}</option>
                                                                @endforeach
                                                            </select>
                                                            @if ($errors->has('districtDivisionId'))
                                                            <span class="help-block">
                                                                <strong><i class="fa fa-warning"></i> {{ $errors->first('districtDivisionId') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="districtName">Name <b style="color: red">*</b></label>
                                                            <input type="text" placeholder="Enter Name" name="districtName" id="districtName" class="form-control" value="{{ $dataList->districtName }}" required/>
                                                            @if ($errors->has('districtName'))
                                                            <span class="help-block">
                                                                <strong><i class="fa fa-warning"></i> {{ $errors->first('districtName') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="districtLat">Latitude</label>
                                                            <input type="text" placeholder="Enter Latitude" name="districtLat" id="districtLat" class="form-control" value="{{ $dataList->districtLat }}" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="districtLong">Longitude</label>
                                                            <input type="text" placeholder="Enter Longitude" name="districtLong" id="districtLong" class="form-control" value="{{ $dataList->districtLong }}" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="districtStatus">Status <b style="color: red">*</b></label>
                                                            <select class="form-control select2" name="districtStatus" id="districtStatus" required>
                                                                <option value="Active"{{ ($dataList->districtStatus == 'Active') ? 'selected' : '' }}>Active</option>
                                                                <option value="Inactive"{{ ($dataList->districtStatus == 'Inactive') ? 'selected' : '' }}>Inactive</option>
                                                            </select>
                                                            @if ($errors->has('districtStatus'))
                                                            <span class="help-block">
                                                                <strong><i class="fa fa-warning"></i> {{ $errors->first('districtStatus') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Submit</button>
                                                    </form>
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
        @include('backend.layout.footerScript')

        <script type="text/javascript">
            $("#districtActive").addClass("active");
            $("#districtActive").parent().parent().addClass("treeview active");
            $("#districtActive").parent().addClass("in");
        </script>
    </body>
</html>
