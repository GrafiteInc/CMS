@extends('cms::layouts.dashboard')

@section('content')
    <div class="row">
        <h1 class="page-header">Files</h1>
    </div>

    @include('cms::modules.files.breadcrumbs', ['location' => ['create']])

    <div class="row">
        {!! Form::open(['url' => 'cms/files/upload', 'files' => true, 'class' => 'dropzone', 'id' => 'fileDropzone']); !!}
        {!! Form::close() !!}
    </div>

    <div class="row">
        {!! Form::open(['route' => config('cms.backend-route-prefix', 'cms').'.files.store', 'files' => true, 'id' => 'fileDetailsForm', 'class' => 'add']); !!}

            {!! FormMaker::fromTable('files', Config::get('cms.forms.files')) !!}

            <div class="form-group text-right">
                <a href="{!! url(config('cms.backend-route-prefix', 'cms').'/files') !!}" class="btn btn-secondary raw-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary', 'id' => 'saveFilesBtn']) !!}
            </div>

        {!! Form::close() !!}
    </div>
@endsection
