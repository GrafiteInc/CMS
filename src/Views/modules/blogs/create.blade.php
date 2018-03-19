@extends('cms::layouts.dashboard')

@section('content')

    <div class="row">
        <h1 class="page-header">Blog</h1>
    </div>

    @include('cms::modules.blogs.breadcrumbs', ['location' => ['create']])

    <div class="row">
        {!! Form::open(['route' => config('cms.backend-route-prefix', 'cms').'.blog.store', 'class' => 'add', 'files' => true]) !!}

            {!! FormMaker::fromTable('blogs', Config::get('cms.forms.blog')) !!}

            <div class="form-group text-right">
                <a href="{!! url(config('cms.backend-route-prefix', 'cms').'/blog') !!}" class="btn btn-default raw-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection
