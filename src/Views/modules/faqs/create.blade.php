@extends('cabin::layouts.dashboard')

@section('content')

    <div class="row">
        <h1 class="page-header">FAQs</h1>
    </div>

    @include('cabin::modules.faqs.breadcrumbs', ['location' => ['create']])

    <div class="row">
        {!! Form::open(['route' => config('cabin.backend-route-prefix', 'cabin').'.faqs.store', 'class' => 'add']) !!}

            {!! FormMaker::fromTable('faqs', Config::get('cabin.forms.faqs')) !!}

            <div class="form-group text-right">
                <a href="{!! url(config('cabin.backend-route-prefix', 'cabin').'/faqs') !!}" class="btn btn-default raw-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection
