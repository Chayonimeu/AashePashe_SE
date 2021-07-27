@if (session('errorArray'))
<div class="alert alert-danger alert-dismissable" style="text-align: left;">
    @foreach($errors->all() AS $key => $value)
    <i class="fa fa-warning"></i> {{ $value }}<br>
    @endforeach
</div>
@endif
@if (session('error'))
<div class="alert alert-danger alert-dismissable" style="text-align: left;">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    <i class="fa fa-warning"></i> {{ session('error') }}
</div>
@endif
@if (session('success'))
<div class="alert alert-success alert-dismissable" style="text-align: left;">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    <i class="fa fa-check"></i> {{ session('success') }}
</div>
@endif