@extends('cabin::layouts.dashboard')

@section('content')

    <div class="row">
        <h1 class="page-header">Blog</h1>
    </div>

    @include('cabin::modules.blogs.breadcrumbs', ['location' => ['create']])

    <div class="row">
        {!! Form::open(['route' => config('cabin.backend-route-prefix', 'cabin').'.blog.store', 'class' => 'add', 'files' => true]) !!}

            {!! FormMaker::fromTable('blogs', Config::get('cabin.forms.blog')) !!}

            <div class="form-group text-right">
                <a href="{!! url(config('cabin.backend-route-prefix', 'cabin').'/blog') !!}" class="btn btn-default raw-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection
