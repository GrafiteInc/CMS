@extends('cabin::layouts.dashboard')

@section('content')

    <div class="row">
        @if (! is_null(request('lang')) && request('lang') !== config('cabin.default-language', 'en') && $blog->translationData(request('lang')))
            @if (isset($blog->translationData(request('lang'))->is_published))
                <a class="btn btn-default pull-right raw-margin-left-8" href="{!! url('blog/'.$blog->translationData(request('lang'))->url) !!}">Live</a>
            @else
                <a class="btn btn-default pull-right raw-margin-left-8" href="{!! url(config('cabin.backend-route-prefix', 'cabin').'/preview/blog/'.$blog->id.'?lang='.request('lang')) !!}">Preview</a>
            @endif
            <a class="btn btn-warning pull-right raw-margin-left-8" href="{!! Cabin::rollbackUrl($blog->translation(request('lang'))) !!}">Rollback</a>
        @else
            @if ($blog->is_published)
                <a class="btn btn-default pull-right raw-margin-left-8" href="{!! url('blog/'.$blog->url) !!}">Live</a>
            @else
                <a class="btn btn-default pull-right raw-margin-left-8" href="{!! url(config('cabin.backend-route-prefix', 'cabin').'/preview/blog/'.$blog->id) !!}">Preview</a>
            @endif
            <a class="btn btn-warning pull-right raw-margin-left-8" href="{!! Cabin::rollbackUrl($blog) !!}">Rollback</a>
            <a class="btn btn-default pull-right raw-margin-left-8" href="{!! url(config('cabin.backend-route-prefix', 'cabin').'/blog/'.$blog->id.'/history') !!}">History</a>
        @endif

        <h1 class="page-header">Blog</h1>
    </div>

    @include('cabin::modules.blogs.breadcrumbs', ['location' => ['edit']])

    <div class="row raw-margin-bottom-24">
        <ul class="nav nav-tabs">
            @foreach(config('cabin.languages') as $short => $language)
                <li role="presentation" @if (request('lang') == $short || is_null(request('lang')) && $short == config('cabin.default-language'))) class="active" @endif><a href="{{ url(config('cabin.backend-route-prefix', 'cabin').'/blog/'.$blog->id.'/edit?lang='.$short) }}">{{ ucfirst($language) }}</a></li>
            @endforeach
        </ul>
    </div>

    @if ($blog->hero_image)
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <img class="thumbnail img-responsive" src="{{ $blog->hero_image_url }}" alt="">
            </div>
        </div>
    @endif

    <div class="row">
        <div class="@if (config('cabin.live-preview', false)) col-md-6 @endif">
            {!! Form::model($blog, ['route' => [config('cabin.backend-route-prefix', 'cabin').'.blog.update', $blog->id], 'method' => 'patch', 'class' => 'edit', 'files' => true]) !!}

                <input type="hidden" name="lang" value="{{ request('lang') }}">

                <div class="form-group">
                    <label for="Template">Template</label>
                    <select class="form-control" id="Template" name="template">
                        @foreach (BlogService::getTemplatesAsOptions() as $template)
                            @if (! is_null(request('lang')) && request('lang') !== config('cabin.default-language', 'en') && $blog->translationData(request('lang')))
                                <option @if($template === $blog->translationData(request('lang'))->template) selected  @endif value="{!! $template !!}">{!! ucfirst(str_replace('-template', '', $template)) !!}</option>
                            @else
                                <option @if($template === $blog->template) selected  @endif value="{!! $template !!}">{!! ucfirst(str_replace('-template', '', $template)) !!}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                @if (! is_null(request('lang')) && request('lang') !== config('cabin.default-language', 'en'))
                    {!! FormMaker::fromObject($blog->translationData(request('lang')), Config::get('cabin.forms.blog')) !!}
                @else
                    {!! FormMaker::fromObject($blog, Config::get('cabin.forms.blog')) !!}
                @endif

                <div class="form-group text-right">
                    <a href="{!! url(config('cabin.backend-route-prefix', 'cabin').'/blog') !!}" class="btn btn-default raw-left">Cancel</a>
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                </div>

            {!! Form::close() !!}
        </div>
        @if (config('cabin.live-preview', false))
            <div class="col-md-6 hidden-sm hidden-xs">
                <div id="wrap">
                    @if (! is_null(request('lang')) && request('lang') !== config('cabin.default-language', 'en'))
                        <iframe id="frame" src="{!! url(config('cabin.backend-route-prefix', 'cabin').'/preview/blog/'.$blog->id.'?lang='.request('lang')) !!}"></iframe>
                    @else
                        <iframe id="frame" src="{{ url(config('cabin.backend-route-prefix', 'cabin').'/preview/blog/'.$blog->id) }}"></iframe>
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
