@extends('quarx::layouts.dashboard')

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
        {!! Form::open(['route' => config('quarx.backend-route-prefix', 'quarx').'.files.store', 'files' => true, 'id' => 'fileDetailsForm', 'class' => 'add']); !!}

            {!! FormMaker::fromTable('files', Config::get('quarx.forms.files')) !!}

            <div class="form-group text-right">
                <a href="{!! url(config('quarx.backend-route-prefix', 'quarx').'/files') !!}" class="btn btn-default raw-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary', 'id' => 'saveFilesBtn']) !!}
            </div>

        {!! Form::close() !!}
    </div>
@endsection
