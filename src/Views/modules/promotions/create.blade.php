@extends('cms::layouts.dashboard')

@section('pageTitle') Promotions @stop

@section('content')

    <div class="col-md-12 mt-2">
        @include('cms::modules.promotions.breadcrumbs', ['location' => ['create']])
    </div>

    <div class="col-md-12">
        {!! Form::open(['route' => cms()->route('promotions.store'), 'class' => 'add']) !!}

            {!! FormMaker::setColumns(3)->fromTable('promotions', config('cms.forms.promotion.identity')) !!}
            {!! FormMaker::setColumns(1)->fromTable('promotions', config('cms.forms.promotion.content')) !!}

            <div class="form-group text-right">
                <a href="{!! cms()->url('promotions') !!}" class="btn btn-secondary float-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection
