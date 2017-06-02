@extends('quarx::layouts.dashboard')

@section('content')

    <div class="row">
        <h1 class="page-header">Blog</h1>
    </div>

    @include('quarx::modules.blogs.breadcrumbs', ['location' => ['create']])

    <div class="row">
        {!! Form::open(['route' => config('quarx.backend-route-prefix', 'quarx').'.blog.store', 'class' => 'add']) !!}

            {!! FormMaker::fromTable('blogs', Config::get('quarx.forms.blog')) !!}

            <div class="form-group text-right">
                <a href="{!! url(config('quarx.backend-route-prefix', 'quarx').'/blog') !!}" class="btn btn-default raw-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection
