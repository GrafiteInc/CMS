@extends('quarx::layouts.dashboard')

@section('content')

    <div class="row">
        <h1 class="page-header">Events</h1>
    </div>

    @include('quarx::modules.events.breadcrumbs', ['location' => ['create']])

    <div class="row">
        {!! Form::open(['route' => 'quarx.events.store', 'class' => 'add']) !!}

            {!! FormMaker::fromTable('events', Config::get('quarx.forms.event')) !!}

            <div class="form-group text-right">
                <a href="{!! URL::to('quarx/events') !!}" class="btn btn-default raw-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection
