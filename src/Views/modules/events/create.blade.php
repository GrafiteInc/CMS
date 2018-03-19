@extends('cms::layouts.dashboard')

@section('content')

    <div class="row">
        <h1 class="page-header">Events</h1>
    </div>

    @include('cms::modules.events.breadcrumbs', ['location' => ['create']])

    <div class="row">
        {!! Form::open(['route' => config('cms.backend-route-prefix', 'cms').'.events.store', 'class' => 'add']) !!}

            {!! FormMaker::fromTable('events', Config::get('cms.forms.event')) !!}

            <div class="form-group text-right">
                <a href="{!! url(config('cms.backend-route-prefix', 'cms').'/events') !!}" class="btn btn-default raw-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection
