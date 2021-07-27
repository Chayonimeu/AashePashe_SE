<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Aashepashe | Add New Hotel</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        @include('backend.layout.panel.header_script')
        <!--CSRF token-->
        <meta name="csrf-token" content="{{ csrf_token() }}">
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
                                    <div class="panel-heading panel-style"><i class="fa fa-clone"></i> Add New Hotel</div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form role="form" class="" method="POST" action="{{ URL::to('portal/merchant/hotel/store') }}" enctype="multipart/form-data">
                                                    {{ csrf_field() }}

                                                    <input type="hidden" name="root_id" value="{{ Auth::guard('merchant')->user()->merchant_id }}" />
                                                    <fieldset class="col-md-12">    	
                                                        <legend>Basic Information</legend>
                                                        <div class="panel panel-default">
                                                            <div class="panel-body">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="branch_id">Branch <b style="color: red">*</b></label>
                                                                            <select class="form-control select2" name="branch_id" id="branch_id" required>
                                                                                <option value="">Choose Branch</option>
                                                                                @foreach($branch_list AS $branch)
                                                                                <option value="{{ $branch->branch_id }}"{{ (old('branch_id') == $branch->branch_id) ? 'selected' : '' }}>{{ $branch->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            @if ($errors->has('branch_id'))
                                                                            <span class="help-block">
                                                                                <strong><i class="fa fa-warning"></i> {{ $errors->first('branch_id') }}</strong>
                                                                            </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="property_id">Property Category <b style="color: red">*</b></label>
                                                                            <select class="form-control select2" name="property_id" id="property_id" required>
                                                                                <option value="">Choose Property</option>
                                                                                @foreach($property_list AS $property)
                                                                                <option value="{{ $property->property_id }}"{{ (old('property_id') == $property->property_id) ? 'selected' : '' }}>{{ $property->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            @if ($errors->has('property_id'))
                                                                            <span class="help-block">
                                                                                <strong><i class="fa fa-warning"></i> {{ $errors->first('property_id') }}</strong>
                                                                            </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="name">Hotel Name <b style="color: red">*</b></label>
                                                                            <input type="text" placeholder="Enter Hotel Name" name="name" id="name" class="form-control" value="{{ old('name') }}" required/>
                                                                            @if ($errors->has('name'))
                                                                            <span class="help-block">
                                                                                <strong><i class="fa fa-warning"></i> {{ $errors->first('name') }}</strong>
                                                                            </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="address">Hotel Address <b style="color: red">*</b></label>
                                                                            <input type="text" placeholder="Enter Hotel Address" name="address" id="address" class="form-control" value="{{ old('address') }}" required/>
                                                                            @if ($errors->has('address'))
                                                                            <span class="help-block">
                                                                                <strong><i class="fa fa-warning"></i> {{ $errors->first('address') }}</strong>
                                                                            </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="hotel_image">Hotel Image <b style="color: red">*</b></label>
                                                                            <input type="file" name="hotel_image" id="hotel_image" class="form-control" required/>
                                                                            <small style="color: darkred"><i class="fa fa-info-circle"></i> Please provide photo of exterior where hotel must be included in the photo</small>
                                                                            @if ($errors->has('hotel_image'))
                                                                            <span class="help-block">
                                                                                <strong><i class="fa fa-warning"></i> {{ $errors->first('hotel_image') }}</strong>
                                                                            </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="certification_image">Certification Image <b style="color: red">*</b></label>
                                                                            <input type="file" name="certification_image" id="certification_image" class="form-control" required/>
                                                                            <small style="color: darkred"><i class="fa fa-info-circle"></i> Please provide photo's of the business license or of a bill which shows the hotel's address (utility bill, internet bill, credit card statement etc)</small>
                                                                            @if ($errors->has('certification_image'))
                                                                            <span class="help-block">
                                                                                <strong><i class="fa fa-warning"></i> {{ $errors->first('certification_image') }}</strong>
                                                                            </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="latitude">Latitude</label>
                                                                            <input type="text" placeholder="Enter Latitude" name="latitude" id="latitude" class="form-control" value="{{ old('latitude') }}"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="longitude">Longitude</label>
                                                                            <input type="text" placeholder="Enter Longitude" name="longitude" id="longitude" class="form-control" value="{{ old('longitude') }}"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="opening_date">Opening Date <span style="color: red">*</span></label>
                                                                            <div class="input-group date">
                                                                                <div class="input-group-addon">
                                                                                    <i class="fa fa-calendar"></i>
                                                                                </div>
                                                                                <input type="text" class="form-control pull-right" id="datepicker" name="opening_date" value="{{ old('opening_date') }}" required="required">
                                                                                @if ($errors->has('opening_date'))
                                                                                <span class="help-block">
                                                                                    <strong><i class="fa fa-warning"></i> {{ $errors->first('opening_date') }}</strong>
                                                                                </span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="renovation_date">Renovation Date</label>
                                                                            <div class="input-group date">
                                                                                <div class="input-group-addon">
                                                                                    <i class="fa fa-calendar"></i>
                                                                                </div>
                                                                                <input type="text" class="form-control pull-right" id="datepicker" name="renovation_date" value="{{ old('renovation_date') }}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    <fieldset class="col-md-12">    	
                                                        <legend>Hotel Details</legend>
                                                        <div class="panel panel-default">
                                                            <div class="panel-body">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="star_rating">Rating <b style="color: red">*</b></label>
                                                                            <select class="form-control select2" name="star_rating" id="star_rating" required>
                                                                                <option value="">Choose Rating</option>
                                                                                <option value="1"{{ (old('star_rating') == '1') ? 'selected' : '' }}>1 Star</option>
                                                                                <option value="2"{{ (old('star_rating') == '2') ? 'selected' : '' }}>2 Star</option>
                                                                                <option value="3"{{ (old('star_rating') == '3') ? 'selected' : '' }}>3 Star</option>
                                                                                <option value="4"{{ (old('star_rating') == '4') ? 'selected' : '' }}>4 Star</option>
                                                                                <option value="5"{{ (old('star_rating') == '5') ? 'selected' : '' }}>5 Star</option>
                                                                                <option value="0"{{ (old('star_rating') == '0') ? 'selected' : '' }}>Not Rated</option>
                                                                            </select>
                                                                            @if ($errors->has('star_rating'))
                                                                            <span class="help-block">
                                                                                <strong><i class="fa fa-warning"></i> {{ $errors->first('star_rating') }}</strong>
                                                                            </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="total_room">No of Rooms <b style="color: red">*</b></label>
                                                                            <input type="number" min="1" placeholder="Enter Total No of Rooms" name="total_room" id="total_room" class="form-control" value="{{ old('total_room') }}" required/>
                                                                            @if ($errors->has('total_room'))
                                                                            <span class="help-block">
                                                                                <strong><i class="fa fa-warning"></i> {{ $errors->first('total_room') }}</strong>
                                                                            </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="website">Official Website</label>
                                                                            <input type="url" placeholder="Enter Valid URL" name="website" id="website" class="form-control" value="{{ old('website') }}"/>
                                                                            @if ($errors->has('website'))
                                                                            <span class="help-block">
                                                                                <strong><i class="fa fa-warning"></i> {{ $errors->first('website') }}</strong>
                                                                            </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label class="control-label" for="details">Details <b style="color: red">*</b></label>
                                                                            <textarea class="form-control" name="details" id="details" required>{{ old('details') }}</textarea>
                                                                            @if ($errors->has('details'))
                                                                            <span class="help-block">
                                                                                <strong><i class="fa fa-warning"></i> {{ $errors->first('details') }}</strong>
                                                                            </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    <fieldset class="col-md-12">    	
                                                        <legend>Contact Information</legend>
                                                        <div class="panel panel-default">
                                                            <div class="panel-body">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="contact_name">Contact Name</label>
                                                                            <input type="text" placeholder="Enter Contact Person Name" name="contact_name" id="contact_name" class="form-control" value="{{ old('contact_name') }}"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="contact_phone">Contact Phone</label>
                                                                            <input type="text" placeholder="Enter Contact Person Phone" name="contact_phone" id="contact_phone" class="form-control" value="{{ old('contact_phone') }}"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="contact_email">Contact Email</label>
                                                                            <input type="email" placeholder="Enter Contact Person Email" name="contact_email" id="contact_email" class="form-control" value="{{ old('contact_email') }}"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    <div class="col-md-12" style="margin-top: 10px">
                                                        <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-check"></i> Submit</button>
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
