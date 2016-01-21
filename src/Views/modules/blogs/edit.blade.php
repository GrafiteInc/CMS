@extends('quarx::layouts.dashboard')

@section('content')

    <div class="row">
        @if ($blog->is_published)
        <a class="btn btn-default pull-right raw-margin-left-8" href="{!! URL::to('blog/'.$blog->url) !!}">Live</a>
        @else
        <a class="btn btn-default pull-right raw-margin-left-8" href="{!! URL::to('quarx/preview/blog/'.CryptoService::encrypt($blog->id)) !!}">Preview</a>
        @endif
        <a class="btn btn-default pull-right raw-margin-left-8" href="{!! URL::to('quarx/rollback/blog/'.CryptoService::encrypt($blog->id)) !!}">Rollback</a>
        <h1 class="page-header">Blog</h1>
    </div>

    @include('quarx::modules.blogs.breadcrumbs', ['location' => ['edit']])

    {!! Form::model($blog, ['route' => ['quarx.blog.update', CryptoService::encrypt($blog->id)], 'method' => 'patch']) !!}

        {!! FormMaker::fromObject($blog, Config::get('quarx.forms.blog')) !!}

        <div class="form-group text-right">
            <a href="{!! URL::to('quarx/blog') !!}" class="btn btn-default raw-left">Cancel</a>
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        </div>

    {!! Form::close() !!}

@endsection
