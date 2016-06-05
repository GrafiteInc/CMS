@extends('quarx::layouts.dashboard')

@section('content')

    <div class="row">
        @if ($blog->is_published)
        <a class="btn btn-default pull-right raw-margin-left-8" href="{!! URL::to('blog/'.$blog->url) !!}">Live</a>
        @else
        <a class="btn btn-default pull-right raw-margin-left-8" href="{!! URL::to('quarx/preview/blog/'.$blog->id) !!}">Preview</a>
        @endif
        <a class="btn btn-warning pull-right raw-margin-left-8" href="{!! URL::to('quarx/rollback/blog/'.$blog->id) !!}">Rollback</a>
        <h1 class="page-header">Blog</h1>
    </div>

    @include('quarx::modules.blogs.breadcrumbs', ['location' => ['edit']])

    {!! Form::model($blog, ['route' => ['quarx.blog.update', $blog->id], 'method' => 'patch', 'class' => 'edit']) !!}

        <div class="form-group">
            <label for="Template">Template</label>
            <select class="form-control" id="Template" name="template">
                @foreach (BlogService::getTemplatesAsOptions() as $template)
                    <option @if($template === $blog->template) selected  @endif value="{!! $template !!}">{!! ucfirst(str_replace('-template', '', $template)) !!}</option>
                @endforeach
            </select>
        </div>

        {!! FormMaker::fromObject($blog, Config::get('quarx.forms.blog')) !!}

        <div class="form-group text-right">
            <a href="{!! URL::to('quarx/blog') !!}" class="btn btn-default raw-left">Cancel</a>
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        </div>

    {!! Form::close() !!}

@endsection
