<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Aashepashe | Faq</title>
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
                                    <div class="panel-heading panel-style"><i class="fa fa-clone"></i> Faq
                                        <a href="{{ URL::to('portal/faq/add') }}" class="pull-right"><i class="fa fa-plus-circle"></i> Add New</a>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                @include('backend.layout.message')
                                                <div class="panel-group" id="faqAccordion">
                                                    @if(count($data_list))
                                                    @foreach($data_list AS $data)
                                                    <div class="panel panel-default" style="margin-bottom: 5px">
                                                        <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question{{ $data->faqId }}">
                                                            <h4 class="panel-title">
                                                                <a href="javascript:void(0)">Q: {{ $data->question }}</a>
                                                            </h4>
                                                        </div>
                                                        <div id="question{{ $data->faqId }}" class="panel-collapse collapse" style="height: 0px;">
                                                            <div class="panel-body">
                                                                <p>{!! $data->answer !!}</p>
                                                                @if($data->status == 'Active')
                                                                <span class="label label-primary">{{ $data->status }}</span>
                                                                @else
                                                                <span class="label label-warning">{{ $data->status }}</span>
                                                                @endif
                                                                <a href="{{ URL::to('portal/faq/edit/'.$data->faq_id) }}"><i class="fa fa-edit action_style" data-toggle="tooltip" data-original-title="Edit"></i></a>
                                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#delete_faq{{ $data->faq_id }}"><i class="fa fa-trash-o action_style" data-toggle="tooltip" data-original-title="Delete"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Delete -->
                                                    <div id="delete_faq{{ $data->faq_id }}" class="modal fade" role="dialog">
                                                        <div class="modal-dialog modal-sm">
                                                            <div class="modal-content">
                                                                <form method="POST" action="{{ URL::to('portal/faq/delete') }}">
                                                                    {{ csrf_field() }}
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                        <input type="hidden" name="faq_id" value="{{ $data->faq_id }}" />
                                                                        <h4 class="modal-title" style="color: #f8ac59;"><i class="fa fa-warning"></i> Warning</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Are you sure want to delete? Click "Yes" to delete.</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-primary" name="btn"><i class="fa fa-check"></i> Yes</button>
                                                                        <button type="button" class="btn btn-primary btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Delete -->
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
                                                <span class="pull-right">{{ $data_list->links() }}</span>
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
        <script type="text/javascript">
            $("#faq_active").addClass("active");
            $("#faq_active").parent().parent().addClass("treeview active");
            $("#faq_active").parent().addClass("in");
        </script>
    </body>
</html>
