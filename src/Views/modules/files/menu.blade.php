<div class="row">
    @if (isset($createBtn))
        <a class="btn btn-primary pull-right" href="{!! cms()->route('files.create') !!}">Add New</a>
    @endif
    <div class="raw-m-hide pull-right raw-m-hide">
        {!! Form::open(['url' => cms()->url('files/search')]) !!}
        <input class="form-control header-input pull-right @if (isset($createBtn)) raw-margin-right-24 @endif" name="term" placeholder="Search">
        {!! Form::close() !!}
    </div>
    <h1 class="page-header">Files</h1>
</div>