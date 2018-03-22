@extends('cms::layouts.dashboard')

@section('pageTitle') Menus @stop

@section('content')

    <div class="col-md-12 mt-2">
        @include('cms::modules.menus.breadcrumbs', ['location' => ['create']])
    </div>

    <div class="col-md-12">
        {!! Form::open(['route' => cms()->route('menus.store'), 'class' => 'add']) !!}

            {!! FormMaker::fromTable('menus', config('cms.forms.menu')) !!}

            <div class="form-group text-right">
                <a href="{!! cms()->url('menus') !!}" class="btn btn-secondary float-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection

