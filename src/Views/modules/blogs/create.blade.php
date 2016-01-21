@extends('quarx::layouts.dashboard')

@section('content')

        <div class="row">
            <h1 class="page-header">Blog</h1>
        </div>

        @include('quarx::modules.blogs.breadcrumbs', ['location' => ['create']])

        {!! Form::open(['route' => 'quarx.blog.store']) !!}

            {!! FormMaker::fromTable('blogs', Config::get('quarx.forms.blog')) !!}

            <div class="form-group text-right">
                <a href="{!! URL::to('quarx/blog') !!}" class="btn btn-default raw-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}

@endsection
