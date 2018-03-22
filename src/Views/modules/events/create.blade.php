@extends('cms::layouts.dashboard')

@section('pageTitle') Events @stop

@section('content')

    <div class="col-md-12 mt-2">
        @include('cms::modules.events.breadcrumbs', ['location' => ['create']])
    </div>

    <div class="col-md-12">
        {!! Form::open(['route' => config('cms.backend-route-prefix', 'cms').'.events.store', 'class' => 'add']) !!}

            {!! FormMaker::fromTable('events', Config::get('cms.forms.event')) !!}

            <div class="form-group text-right">
                <a href="{!! url(config('cms.backend-route-prefix', 'cms').'/events') !!}" class="btn btn-secondary float-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection
