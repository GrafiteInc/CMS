@extends('quarx::layouts.dashboard')

@section('content')

    <div class="row">
        <h1 class="page-header">Events</h1>
    </div>

    @include('quarx::modules.events.breadcrumbs', ['location' => ['create']])

    {!! Form::open(['route' => 'quarx.events.store']) !!}

        {!! FormMaker::fromTable('events', Config::get('quarx.forms.event')) !!}

        <div class="form-group text-right">
            <a href="{!! URL::previous() !!}" class="btn btn-default raw-left">Cancel</a>
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        </div>

    {!! Form::close() !!}

@endsection
