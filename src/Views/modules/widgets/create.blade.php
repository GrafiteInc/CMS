@extends('cms::layouts.dashboard')

@section('pageTitle') Widgets @stop

@section('content')

    <div class="col-md-12 mt-2">
        @include('cms::modules.widgets.breadcrumbs', ['location' => ['create']])
    </div>

    <div class="col-md-12">
        {!! Form::open(['route' => config('cms.backend-route-prefix', 'cms').'.widgets.store', 'class' => 'add']) !!}

            {!! FormMaker::fromTable('widgets', Config::get('cms.forms.widget')) !!}

            <div class="form-group text-right">
                <a href="{!! url(config('cms.backend-route-prefix', 'cms').'/widgets') !!}" class="btn btn-secondary raw-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection
