@extends('quarx::layouts.dashboard')

@section('content')

    <div class="row">
        @if (! is_null(request('lang')) && request('lang') !== config('quarx.default-language', 'en') && $blog->translationData(request('lang')))
            @if (isset($blog->translationData(request('lang'))->is_published))
                <a class="btn btn-default pull-right raw-margin-left-8" href="{!! url('blog/'.$blog->translationData(request('lang'))->url) !!}">Live</a>
            @else
                <a class="btn btn-default pull-right raw-margin-left-8" href="{!! url(config('quarx.backend-route-prefix', 'quarx').'/preview/blog/'.$blog->id.'?lang='.request('lang')) !!}">Preview</a>
            @endif
            <a class="btn btn-warning pull-right raw-margin-left-8" href="{!! Quarx::rollbackUrl($blog->translation(request('lang'))) !!}">Rollback</a>
        @else
            @if ($blog->is_published)
                <a class="btn btn-default pull-right raw-margin-left-8" href="{!! url('blog/'.$blog->url) !!}">Live</a>
            @else
                <a class="btn btn-default pull-right raw-margin-left-8" href="{!! url(config('quarx.backend-route-prefix', 'quarx').'/preview/blog/'.$blog->id) !!}">Preview</a>
            @endif
            <a class="btn btn-warning pull-right raw-margin-left-8" href="{!! Quarx::rollbackUrl($blog) !!}">Rollback</a>
            <a class="btn btn-default pull-right raw-margin-left-8" href="{!! url(config('quarx.backend-route-prefix', 'quarx').'/blog/'.$blog->id.'/history') !!}">History</a>
        @endif

        <h1 class="page-header">Blog</h1>
    </div>

    @include('quarx::modules.blogs.breadcrumbs', ['location' => ['edit']])

    <div class="row raw-margin-bottom-24">
        <ul class="nav nav-tabs">
            @foreach(config('quarx.languages') as $short => $language)
                <li role="presentation" @if (request('lang') == $short || is_null(request('lang')) && $short == config('quarx.default-language'))) class="active" @endif><a href="{{ url(config('quarx.backend-route-prefix', 'quarx').'/blog/'.$blog->id.'/edit?lang='.$short) }}">{{ ucfirst($language) }}</a></li>
            @endforeach
        </ul>
    </div>

    <div class="row">
        <div class="@if (config('quarx.live-preview', false)) col-md-6 @endif">
            {!! Form::model($blog, ['route' => [config('quarx.backend-route-prefix', 'quarx').'.blog.update', $blog->id], 'method' => 'patch', 'class' => 'edit']) !!}

                <input type="hidden" name="lang" value="{{ request('lang') }}">

                <div class="form-group">
                    <label for="Template">Template</label>
                    <select class="form-control" id="Template" name="template">
                        @foreach (BlogService::getTemplatesAsOptions() as $template)
                            @if (! is_null(request('lang')) && request('lang') !== config('quarx.default-language', 'en') && $blog->translationData(request('lang')))
                                <option @if($template === $blog->translationData(request('lang'))->template) selected  @endif value="{!! $template !!}">{!! ucfirst(str_replace('-template', '', $template)) !!}</option>
                            @else
                                <option @if($template === $blog->template) selected  @endif value="{!! $template !!}">{!! ucfirst(str_replace('-template', '', $template)) !!}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                @if (! is_null(request('lang')) && request('lang') !== config('quarx.default-language', 'en'))
                    {!! FormMaker::fromObject($blog->translationData(request('lang')), Config::get('quarx.forms.blog')) !!}
                @else
                    {!! FormMaker::fromObject($blog, Config::get('quarx.forms.blog')) !!}
                @endif

                <div class="form-group text-right">
                    <a href="{!! url(config('quarx.backend-route-prefix', 'quarx').'/blog') !!}" class="btn btn-default raw-left">Cancel</a>
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                </div>

            {!! Form::close() !!}
        </div>
        @if (config('quarx.live-preview', false))
            <div class="col-md-6 hidden-sm hidden-xs">
                <div id="wrap">
                    @if (! is_null(request('lang')) && request('lang') !== config('quarx.default-language', 'en'))
                        <iframe id="frame" src="{!! url(config('quarx.backend-route-prefix', 'quarx').'/preview/blog/'.$blog->id.'?lang='.request('lang')) !!}"></iframe>
                    @else
                        <iframe id="frame" src="{{ url(config('quarx.backend-route-prefix', 'quarx').'/preview/blog/'.$blog->id) }}"></iframe>
                    @endif
                </div>
                <div id="frameButtons" class="raw-margin-top-16">
                    <button class="btn btn-default preview-toggle" data-platform="desktop">Desktop</button>
                    <button class="btn btn-default preview-toggle" data-platform="mobile">Mobile</button>
                </div>
            </div>
        @endif
    </div>

@endsection
