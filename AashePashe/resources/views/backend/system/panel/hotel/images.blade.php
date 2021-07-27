<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Aashepashe | Hotel Images</title>
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
                                        <i class="fa fa-clone"></i> Hotel Images For {{ $data_list->name }}
                                    </div>
                                    <div class="panel-body">
                                        @include('backend.layout.panel.message')
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="box">
                                                    <div class="box-header with-border">
                                                        <h3 class="box-title">Add More Hotel Images</h3>
                                                    </div>
                                                    <div class="box-body">
                                                        <small style="color: darkred"><i class="fa fa-info-circle"></i> You can choose 10 images at a time</small><br>
                                                        <small style="color: darkred"><i class="fa fa-info-circle"></i> Only .jpg, .png, .gif are supported</small><br>
                                                        <small style="color: darkred"><i class="fa fa-info-circle"></i> Images should not have watermark or other text and should be filled under the proper category</small><br>
                                                        <small style="color: darkred"><i class="fa fa-info-circle"></i> Violent, pornographic and other types of illegal images or information is not permitted</small><br>
                                                        <form role="form" class="form-inline" method="POST" action="{{ URL::to('portal/merchant/hotel/images/store') }}" enctype="multipart/form-data">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="hotel_info_id" value="{{ $data_list->hotel_info_id }}" />
                                                            <div class="form-group">
                                                                <label for="image">Choose Multiple Image <b style="color: red">*</b></label>
                                                                <input type="file" multiple="multiple" accept="image/png, image/jpeg, image/gif" name="image[]" id="image" class="form-control" required/>
                                                                @if ($errors->has('image'))
                                                                <span class="help-block">
                                                                    <strong><i class="fa fa-warning"></i> {{ $errors->first('image') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Submit</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="box">
                                                    <div class="box-header with-border">
                                                        <h3 class="box-title">Hotel Images</h3>
                                                    </div>
                                                    <div class="box-body">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <img style="height: 150px;width: 100%" src="{{ url('upload/hotel/'.$data_list->hotel_image) }}" alt="Image" class="img img-responsive img-thumbnail">
                                                                <a href=""><i class="fa fa-edit"></i>Edit</a>&nbsp;
                                                                <a href="#"><i class="fa fa-trash"></i>Delete</a>
                                                            </div>
                                                            @foreach($hotel_image AS $image)
                                                            <div class="col-md-3">
                                                                <img style="height: 150px;width: 100%" src="{{ url('upload/hotel/'.$image->image) }}" alt="Image" class="img img-responsive img-thumbnail">
                                                                <a href=""><i class="fa fa-edit"></i>Edit</a>&nbsp;
                                                                <a href="#"><i class="fa fa-trash"></i>Delete</a>
                                                            </div>
                                                            @endforeach
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
