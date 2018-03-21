@extends('cms::layouts.dashboard')

@section('pageTitle') Blog @stop

@section('content')

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6 mt-2">
                @include('cms::modules.blogs.breadcrumbs', ['location' => ['edit']])
            </div>
            <div class="col-md-6">
                <div class="btn-toolbar float-right mt-2">
                    @if (! is_null(request('lang')) && request('lang') !== config('cms.default-language', 'en') && $blog->translationData(request('lang')))
                        @if (isset($blog->translationData(request('lang'))->is_published))
                            <a class="btn btn-success pull-right ml-1" href="{!! url('blog/'.$blog->translationData(request('lang'))->url) !!}">Live</a>
                        @else
                            <a class="btn btn-outline-secondary pull-right ml-1" href="{!! url(config('cms.backend-route-prefix', 'cms').'/preview/blog/'.$blog->id.'?lang='.request('lang')) !!}">Preview</a>
                        @endif
                        <a class="btn btn-warning pull-right ml-1" href="{!! Cms::rollbackUrl($blog->translation(request('lang'))) !!}">Rollback</a>
                    @else
                        @if ($blog->is_published)
                            <a class="btn btn-success pull-right ml-1" href="{!! url('blog/'.$blog->url) !!}">Live</a>
                        @else
                            <a class="btn btn-outline-secondary pull-right ml-1" href="{!! url(config('cms.backend-route-prefix', 'cms').'/preview/blog/'.$blog->id) !!}">Preview</a>
                        @endif
                        <a class="btn btn-warning pull-right ml-1" href="{!! Cms::rollbackUrl($blog) !!}">Rollback</a>
                        <a class="btn btn-outline-secondary pull-right ml-1" href="{!! url(config('cms.backend-route-prefix', 'cms').'/blog/'.$blog->id.'/history') !!}">History</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="row mb-4">
            <div class="col-md-12">
                <ul class="nav nav-tabs">
                    @include('cms::layouts.tabs', [ 'module' => 'blog', 'item' => $blog ])
                </ul>
            </div>
        </div>

        @if ($blog->hero_image)
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <img class="thumbnail img-responsive" src="{{ $blog->hero_image_url }}" alt="">
                </div>
            </div>
        @endif

        <div class="row">
            <div class="@if (config('cms.live-preview', false)) col-md-6 @else col-md-12 @endif">
                {!! Form::model($blog, ['route' => [config('cms.backend-route-prefix', 'cms').'.blog.update', $blog->id], 'method' => 'patch', 'class' => 'edit', 'files' => true]) !!}

                    <input type="hidden" name="lang" value="{{ request('lang') }}">

                    <div class="form-group">
                        <label for="Template">Template</label>
                        <select class="form-control" id="Template" name="template">
                            @foreach (BlogService::getTemplatesAsOptions() as $template)
                                @if (! is_null(request('lang')) && request('lang') !== config('cms.default-language', 'en') && $blog->translationData(request('lang')))
                                    <option @if($template === $blog->translationData(request('lang'))->template) selected  @endif value="{!! $template !!}">{!! ucfirst(str_replace('-template', '', $template)) !!}</option>
                                @else
                                    <option @if($template === $blog->template) selected  @endif value="{!! $template !!}">{!! ucfirst(str_replace('-template', '', $template)) !!}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    {!! FormMaker::fromObject($blog->asObject(), Config::get('cms.forms.blog')) !!}

                    <div class="form-group text-right">
                        <a href="{!! url(config('cms.backend-route-prefix', 'cms').'/blog') !!}" class="btn btn-default raw-left">Cancel</a>
                        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                    </div>

                {!! Form::close() !!}
            </div>
            @if (config('cms.live-preview', false))
                <div class="col-md-6 hidden-sm hidden-xs">
                    <div id="wrap">
                        @if (! is_null(request('lang')) && request('lang') !== config('cms.default-language', 'en'))
                            <iframe id="frame" src="{!! url(config('cms.backend-route-prefix', 'cms').'/preview/blog/'.$blog->id.'?lang='.request('lang')) !!}"></iframe>
                        @else
                            <iframe id="frame" src="{{ url(config('cms.backend-route-prefix', 'cms').'/preview/blog/'.$blog->id) }}"></iframe>
                        @endif
                    </div>
                    <div id="frameButtons" class="raw-margin-top-16">
                        <button class="btn btn-default preview-toggle" data-platform="desktop">Desktop</button>
                        <button class="btn btn-default preview-toggle" data-platform="mobile">Mobile</button>
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection
