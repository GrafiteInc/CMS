@extends('cabin::layouts.dashboard')

@section('content')

    <div class="row">
        <h1 class="page-header">Menus</h1>
    </div>

    @include('cabin::modules.menus.breadcrumbs', ['location' => ['create']])

    <div class="row">
        {!! Form::open(['route' => config('cabin.backend-route-prefix', 'cabin').'.menus.store', 'class' => 'add']) !!}

            {!! FormMaker::fromTable('menus', Config::get('cabin.forms.menu')) !!}

            <div class="form-group text-right">
                <a href="{!! url(config('cabin.backend-route-prefix', 'cabin').'/menus') !!}" class="btn btn-default raw-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection

