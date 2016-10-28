@extends('quarx::layouts.dashboard')

@section('stylesheets')

    @parent
    {!! Minify::stylesheet(Quarx::asset('packages/dropzone/basic.css', 'text/css')) !!}
    {!! Minify::stylesheet(Quarx::asset('packages/dropzone/dropzone.css', 'text/css')) !!}
    {!! Minify::stylesheet(Quarx::asset('css/files-module.css', 'text/css')) !!}

@endsection

@section('content')
    <div class="row">
        <h1 class="page-header">Files</h1>
    </div>

    @include('quarx::modules.files.breadcrumbs', ['location' => ['create']])

    <div class="row">
        {!! Form::open(['url' => 'quarx/files/upload', 'files' => true, 'class' => 'dropzone', 'id' => 'fileDropzone']); !!}
        {!! Form::close() !!}
    </div>

    <div class="row">
        {!! Form::open(['route' => 'quarx.files.store', 'files' => true, 'id' => 'fileDetailsForm', 'class' => 'add']); !!}

            {!! FormMaker::fromTable('files', Config::get('quarx.forms.files')) !!}

            <div class="form-group text-right">
                <a href="{!! URL::to('quarx/files') !!}" class="btn btn-default raw-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary', 'id' => 'saveFilesBtn']) !!}
            </div>

        {!! Form::close() !!}
    </div>
@endsection

@section('javascript')

    @parent
    {!! Minify::javascript(Quarx::asset('packages/dropzone/dropzone.js', 'application/javascript')) !!}
    {!! Minify::javascript(Quarx::asset('js/files-module.js', 'application/javascript')) !!}
    {!! Minify::javascript(Quarx::asset('js/dropzone-custom.js', 'application/javascript')) !!}

@stop
