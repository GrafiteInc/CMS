@extends('cms::layouts.dashboard')

@section('pageTitle') Pages @stop

@section('content')
    @include('cms::modules.pages.breadcrumbs', ['location' => ['create']])

    <div class="row">
        <div class="col-md-12 mt-4">
            {!! Form::open(['route' => config('cms.backend-route-prefix', 'cms').'.pages.store', 'class' => 'add', 'files' => true]) !!}

                {!! FormMaker::setColumns(2)->fromTable('pages', Config::get('cms.forms.page.identity')) !!}
                {!! FormMaker::setColumns(2)->fromTable('pages', Config::get('cms.forms.page.content')) !!}
                {!! FormMaker::setColumns(2)->fromTable('pages', Config::get('cms.forms.page.seo')) !!}
                {!! FormMaker::setColumns(2)->fromTable('pages', Config::get('cms.forms.page.publish')) !!}

                <div class="form-group text-right">
                    <a href="{!! url(config('cms.backend-route-prefix', 'cms').'/pages') !!}" class="btn btn-secondary raw-left">Cancel</a>
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsection
