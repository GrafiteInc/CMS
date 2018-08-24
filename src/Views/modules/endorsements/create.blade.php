@extends('cms::layouts.dashboard')

@section('pageTitle') Endorsements @stop

@section('content')

    <div class="col-md-12 mt-2">
        @include('cms::modules.endorsements.breadcrumbs', ['location' => ['create']])
    </div>

    <div class="col-md-12">
        {!! Form::open(['route' => cms()->route('endorsements.store'), 'class' => 'add']) !!}

            {!! FormMaker::setColumns(3)->fromTable('endorsements', config('cms.forms.endorsement.identity')) !!}
            {!! FormMaker::setColumns(1)->fromTable('endorsements', config('cms.forms.endorsement.content')) !!}

            <div class="form-group text-right">
                <a href="{!! cms()->url('endorsements') !!}" class="btn btn-secondary float-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection
