@extends('quarx::layouts.dashboard')

@section('content')

    <div class="row">
        <h1 class="page-header">Widgets</h1>
    </div>

    @include('quarx::modules.widgets.breadcrumbs', ['location' => ['create']])

    <div class="row">
        {!! Form::open(['route' => 'quarx.widgets.store', 'class' => 'add']) !!}

            {!! FormMaker::fromTable('widgets', Config::get('quarx.forms.widget')) !!}

            <div class="form-group text-right">
                <a href="{!! URL::to('quarx/widgets') !!}" class="btn btn-default raw-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection
