@extends('cms::layouts.dashboard')

@section('content')
    <div class="row">
        <h1 class="page-header">Pages</h1>
    </div>

    @include('cms::modules.pages.breadcrumbs', ['location' => ['create']])

    <div class="row">
        {!! Form::open(['route' => config('cms.backend-route-prefix', 'cms').'.pages.store', 'class' => 'add', 'files' => true]) !!}

            {!! FormMaker::fromTable('pages', Config::get('cms.forms.page')) !!}

            <div class="form-group text-right">
                <a href="{!! url(config('cms.backend-route-prefix', 'cms').'/pages') !!}" class="btn btn-default raw-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>
@endsection
