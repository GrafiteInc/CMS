@extends('cms::layouts.dashboard')

@section('pageTitle') Blog @stop

@section('content')

    <div class="col-md-12 mt-2">
        @include('cms::modules.blogs.breadcrumbs', ['location' => ['create']])
    </div>
    <div class="col-md-12">
        {!! Form::open(['route' => cms()->route('blog.store'), 'class' => 'add', 'files' => true]) !!}

            {!! FormMaker::fromTable('blogs', Config::get('cms.forms.blog')) !!}

            <div class="form-group text-right">
                <a href="{!! cms()->url('blog') !!}" class="btn btn-secondary float-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection
