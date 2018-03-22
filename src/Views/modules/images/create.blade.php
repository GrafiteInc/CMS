@extends('cms::layouts.dashboard')

@section('content')

    <div class="row">
        <h1 class="page-header">Images</h1>
    </div>

    @include('cms::modules.images.breadcrumbs', ['location' => ['create']])

    <div class="row">
        {!! Form::open(['url' => 'cms/images/upload', 'files' => true, 'class' => 'dropzone', 'id' => 'fileDropzone']); !!}
        {!! Form::close() !!}

        {!! Form::open(['route' => config('cms.backend-route-prefix', 'cms').'.images.store', 'files' => true, 'id' => 'fileDetailsForm', 'class' => 'add']) !!}

            {!! FormMaker::fromTable('files', Config::get('cms.forms.images')) !!}

            <div class="form-group text-right">
                <a href="{!! url(config('cms.backend-route-prefix', 'cms').'/images') !!}" class="btn btn-secondary raw-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary', 'id' => 'saveImagesBtn']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection
