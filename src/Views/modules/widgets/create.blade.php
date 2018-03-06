@extends('cabin::layouts.dashboard')

@section('content')

    <div class="row">
        <h1 class="page-header">Widgets</h1>
    </div>

    @include('cabin::modules.widgets.breadcrumbs', ['location' => ['create']])

    <div class="row">
        {!! Form::open(['route' => config('cabin.backend-route-prefix', 'cabin').'.widgets.store', 'class' => 'add']) !!}

            {!! FormMaker::fromTable('widgets', Config::get('cabin.forms.widget')) !!}

            <div class="form-group text-right">
                <a href="{!! url(config('cabin.backend-route-prefix', 'cabin').'/widgets') !!}" class="btn btn-default raw-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection
