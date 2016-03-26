@extends('quarx::layouts.dashboard')

@section('stylesheets')

    @parent
    {!! Minify::stylesheet(Quarx::asset('packages/dropzone/basic.css', 'text/css')) !!}
    {!! Minify::stylesheet(Quarx::asset('packages/dropzone/dropzone.css', 'text/css')) !!}
    {!! Minify::stylesheet(Quarx::asset('css/files-module.css', 'text/css')) !!}

@endsection

@section('content')

        <div class="row">
            <h1 class="page-header">Images</h1>
        </div>

        @include('quarx::modules.images.breadcrumbs', ['location' => ['create']])

        {!! Form::open(['url' => 'quarx/images/upload', 'files' => true, 'class' => 'dropzone', 'id' => 'fileDropzone']); !!}
        {!! Form::close() !!}

        {!! Form::open(['route' => 'quarx.images.store', 'files' => true, 'id' => 'fileDetailsForm']) !!}

            {!! FormMaker::fromTable('files', Config::get('quarx.forms.images')) !!}

            <div class="form-group text-right">
                <a href="{!! URL::to('quarx/images') !!}" class="btn btn-default raw-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary', 'id' => 'saveImagesBtn']) !!}
            </div>

        {!! Form::close() !!}

@endsection

@section('javascript')

    @parent
    {!! Minify::javascript(Quarx::asset('packages/dropzone/dropzone.js', 'application/javascript')) !!}
    {!! Minify::javascript(Quarx::asset('js/images-module.js', 'application/javascript')) !!}
    {!! Minify::javascript(Quarx::asset('js/dropzone-custom.js', 'application/javascript')) !!}

@stop
