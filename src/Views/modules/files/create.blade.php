@extends('cabin::layouts.dashboard')

@section('content')
    <div class="row">
        <h1 class="page-header">Files</h1>
    </div>

    @include('cabin::modules.files.breadcrumbs', ['location' => ['create']])

    <div class="row">
        {!! Form::open(['url' => 'cabin/files/upload', 'files' => true, 'class' => 'dropzone', 'id' => 'fileDropzone']); !!}
        {!! Form::close() !!}
    </div>

    <div class="row">
        {!! Form::open(['route' => config('cabin.backend-route-prefix', 'cabin').'.files.store', 'files' => true, 'id' => 'fileDetailsForm', 'class' => 'add']); !!}

            {!! FormMaker::fromTable('files', Config::get('cabin.forms.files')) !!}

            <div class="form-group text-right">
                <a href="{!! url(config('cabin.backend-route-prefix', 'cabin').'/files') !!}" class="btn btn-default raw-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary', 'id' => 'saveFilesBtn']) !!}
            </div>

        {!! Form::close() !!}
    </div>
@endsection
