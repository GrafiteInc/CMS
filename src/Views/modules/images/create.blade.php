@extends('cabin::layouts.dashboard')

@section('content')

    <div class="row">
        <h1 class="page-header">Images</h1>
    </div>

    @include('cabin::modules.images.breadcrumbs', ['location' => ['create']])

    <div class="row">
        {!! Form::open(['url' => 'cabin/images/upload', 'files' => true, 'class' => 'dropzone', 'id' => 'fileDropzone']); !!}
        {!! Form::close() !!}

        {!! Form::open(['route' => config('cabin.backend-route-prefix', 'cabin').'.images.store', 'files' => true, 'id' => 'fileDetailsForm', 'class' => 'add']) !!}

            {!! FormMaker::fromTable('files', Config::get('cabin.forms.images')) !!}

            <div class="form-group text-right">
                <a href="{!! url(config('cabin.backend-route-prefix', 'cabin').'/images') !!}" class="btn btn-default raw-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary', 'id' => 'saveImagesBtn']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection
