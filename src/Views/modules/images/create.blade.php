@extends('cms::layouts.dashboard')

@section('pageTitle') Images @stop

@section('content')

    <div class="col-md-12 mt-2">
        @include('cms::modules.images.breadcrumbs', ['location' => ['create']])
    </div>

    <div class="col-md-12 mt-2">
        {!! Form::open(['url' => cms()->url('images/upload'), 'files' => true, 'class' => 'dropzone', 'id' => 'fileDropzone']); !!}
        {!! Form::close() !!}

        {!! Form::open(['route' => cms()->route('images.store'), 'files' => true, 'id' => 'fileDetailsForm', 'class' => 'add']) !!}

            {!! FormMaker::fromTable('files', config('cms.forms.images')) !!}

            <div class="form-group text-right">
                <a href="{!! cms()->url('images') !!}" class="btn btn-secondary float-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary', 'id' => 'saveImagesBtn']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection
