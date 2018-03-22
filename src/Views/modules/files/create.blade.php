@extends('cms::layouts.dashboard')

@section('pageTitle') Files @stop

@section('content')

    <div class="col-md-12 mt-2">
        @include('cms::modules.files.breadcrumbs', ['location' => ['create']])
    </div>

    <div class="col-md-12">
        {!! Form::open(['url' => 'cms/files/upload', 'files' => true, 'class' => 'dropzone', 'id' => 'fileDropzone']); !!}
        {!! Form::close() !!}
    </div>

    <div class="col-md-12">
        {!! Form::open(['route' => config('cms.backend-route-prefix', 'cms').'.files.store', 'files' => true, 'id' => 'fileDetailsForm', 'class' => 'add']); !!}

            {!! FormMaker::setColumns(2)->fromTable('files', Config::get('cms.forms.files')) !!}

            <div class="form-group text-right">
                <a href="{!! url(config('cms.backend-route-prefix', 'cms').'/files') !!}" class="btn btn-secondary raw-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary', 'id' => 'saveFilesBtn']) !!}
            </div>

        {!! Form::close() !!}
    </div>
@endsection
