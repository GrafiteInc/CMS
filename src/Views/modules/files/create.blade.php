@extends('quarx::layouts.dashboard')

@section('stylesheets')

    @parent
    {!! Minify::stylesheet(Quarx::asset('packages/dropzone/basic.css', 'text/css')) !!}
    {!! Minify::stylesheet(Quarx::asset('packages/dropzone/dropzone.css', 'text/css')) !!}
    {!! Minify::stylesheet(Quarx::asset('css/files-module.css', 'text/css')) !!}

@endsection

@section('content')

        @include('quarx::modules.files.menu')

        @include('quarx::modules.files.breadcrumbs', ['location' => ['create']])

        {!! Form::open(['url' => 'quarx/files/upload', 'files' => true, 'class' => 'dropzone', 'id' => 'fileDropzone']); !!}
        {!! Form::close() !!}

        {!! Form::open(['route' => 'quarx.files.store', 'files' => true, 'id' => 'fileDetailsForm']); !!}

            {!! FormMaker::fromTable('files', Config::get('quarx.forms.files')) !!}

            <div class="form-group text-right">
                {!! Form::submit('Save', ['class' => 'btn btn-primary', 'id' => 'saveFilesBtn']) !!}
            </div>

        {!! Form::close() !!}

@endsection

@section('javascript')

    @parent
    {!! Minify::javascript(Quarx::asset('js/bootstrap-tagsinput.min.js', 'application/javascript')) !!}
    {!! Minify::javascript(Quarx::asset('packages/dropzone/dropzone.js', 'application/javascript')) !!}
    {!! Minify::javascript(Quarx::asset('js/files-module.js', 'application/javascript')) !!}
    {!! Minify::javascript(Quarx::asset('js/dropzone-custom.js', 'application/javascript')) !!}

@stop
