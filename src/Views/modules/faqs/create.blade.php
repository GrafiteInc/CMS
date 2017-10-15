@extends('quarx::layouts.dashboard')

@section('content')

    <div class="row">
        <h1 class="page-header">FAQs</h1>
    </div>

    @include('quarx::modules.faqs.breadcrumbs', ['location' => ['create']])

    <div class="row">
        {!! Form::open(['route' => config('quarx.backend-route-prefix', 'quarx').'.faqs.store', 'class' => 'add']) !!}

            {!! FormMaker::fromTable('faqs', Config::get('quarx.forms.faqs')) !!}

            <div class="form-group text-right">
                <a href="{!! url(config('quarx.backend-route-prefix', 'quarx').'/faqs') !!}" class="btn btn-default raw-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection
