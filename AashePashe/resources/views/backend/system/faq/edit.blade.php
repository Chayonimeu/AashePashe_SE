<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Aashepashe | Edit Faq</title>
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
                                    <div class="panel-heading panel-style"><i class="fa fa-clone"></i> Edit Faq
                                        <a href="{{ url()->previous() }}" class="pull-right"><i class="fa fa-arrow-circle-left"></i> Go Back</a>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                @include('backend.layout.message')
                                                <form role="form" method="POST" action="{{ URL::to('portal/faq/update') }}" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="faq_id" value="{{ $data_list->faq_id }}" />
                                                    <div class="form-group">
                                                        <label class="control-label" for="question">Question <b style="color: red">*</b></label>
                                                        <textarea class="form-control" name="question" id="question">{{ $data_list->question }}</textarea>
                                                        @if ($errors->has('question'))
                                                        <span class="help-block">
                                                            <strong><i class="fa fa-warning"></i> {{ $errors->first('question') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label" for="answer">Answer <b style="color: red">*</b></label>
                                                        <textarea class="form-control" name="answer" id="answer">{{ $data_list->answer }}</textarea>
                                                        @if ($errors->has('answer'))
                                                        <span class="help-block">
                                                            <strong><i class="fa fa-warning"></i> {{ $errors->first('answer') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="status">Status <b style="color: red">*</b></label>
                                                        <select class="form-control" name="status" id="status" required>
                                                            <option value="Active"{{ ($data_list->status == 'Active') ? 'selected' : '' }}>Active</option>
                                                            <option value="Inactive"{{ ($data_list->status == 'Inactive') ? 'selected' : '' }}>Inactive</option>
                                                        </select>
                                                        @if ($errors->has('status'))
                                                        <span class="help-block">
                                                            <strong><i class="fa fa-warning"></i> {{ $errors->first('status') }}</strong>
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
                </section>
            </div>
            @include('backend.layout.footer')
        </div>
        @include('backend.layout.footer_script')
        <script src="https://adminlte.io/themes/AdminLTE/bower_components/ckeditor/ckeditor.js">
        </script>
        <script>
            $(document).ready(function () {
                CKEDITOR.replace('answer');
            });
        </script>
        <script type="text/javascript">
            $("#faq_active").addClass("active");
            $("#faq_active").parent().parent().addClass("treeview active");
            $("#faq_active").parent().addClass("in");
        </script>
    </body>
</html>
