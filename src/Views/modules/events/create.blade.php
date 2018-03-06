@extends('cabin::layouts.dashboard')

@section('content')

    <div class="row">
        <h1 class="page-header">Events</h1>
    </div>

    @include('cabin::modules.events.breadcrumbs', ['location' => ['create']])

    <div class="row">
        {!! Form::open(['route' => config('cabin.backend-route-prefix', 'cabin').'.events.store', 'class' => 'add']) !!}

            {!! FormMaker::fromTable('events', Config::get('cabin.forms.event')) !!}

            <div class="form-group text-right">
                <a href="{!! url(config('cabin.backend-route-prefix', 'cabin').'/events') !!}" class="btn btn-default raw-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection
