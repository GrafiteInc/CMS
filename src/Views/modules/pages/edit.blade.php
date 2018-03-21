@extends('cms::layouts.dashboard')

@section('pageTitle') Pages @stop

@section('content')

    <div class="row">
        <div class="col-md-6">
            @include('cms::modules.pages.breadcrumbs', ['location' => ['edit']])
        </div>
        <div class="col-md-6">
            <div class="btn-toolbar  float-right">
                @if (! is_null(request('lang')) && request('lang') !== config('cms.default-language', 'en') && $page->translationData(request('lang')))
                    @if (isset($page->translationData(request('lang'))->is_published))
                        <a class="btn btn-outline-primary ml-1" href="{!! url('page/'.$page->translationData(request('lang'))->url) !!}">Live</a>
                    @else
                        <a class="btn btn-outline-primary ml-1" href="{!! url(config('cms.backend-route-prefix', 'cms').'/preview/page/'.$page->id.'?lang='.request('lang')) !!}">Preview</a>
                    @endif
                     <a class="btn btn-warning ml-1" href="{!! Cms::rollbackUrl($page->translation(request('lang'))) !!}">Rollback</a>
                @else
                    @if ($page->is_published)
                        <a class="btn btn-outline-primary ml-1" href="{!! url('page/'.$page->url) !!}">Live</a>
                    @else
                        <a class="btn btn-outline-primary ml-1" href="{!! url(config('cms.backend-route-prefix', 'cms').'/preview/page/'.$page->id) !!}">Preview</a>
                    @endif
                    <a class="btn btn-warning ml-1" href="{!! Cms::rollbackUrl($page) !!}">Rollback</a>
                    <a class="btn btn-outline-primary ml-1" href="{!! url(config('cms.backend-route-prefix', 'cms').'/pages/'.$page->id.'/history') !!}">History</a>
                @endif
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-12">
            <ul class="nav nav-tabs">
                @include('cms::layouts.tabs', [ 'module' => 'pages' ])
            </ul>
        </div>
    </div>

    @if ($page->hero_image)
        <div class="row">
            <div class="col-md-6 offset-md-3 mb-4">
                <img class="thumbnail img-responsive" src="{{ $page->hero_image_url }}" alt="">
            </div>
        </div>
    @endif

    <div class="row">
        <div class="@if (config('cms.live-preview', false)) col-md-6 @else col-md-12 @endif">
            {!! Form::model($page, ['route' => [config('cms.backend-route-prefix', 'cms').'.pages.update', $page->id], 'method' => 'patch', 'class' => 'edit', 'files' => true]) !!}

                <input type="hidden" name="lang" value="{{ request('lang') }}">

                {!! FormMaker::setColumns(2)->fromObject($page->asObject(), Config::get('cms.forms.page.identity')) !!}

                <div class="form-group">
                    <label for="Template">Template</label>
                    <select class="form-control" id="Template" name="template">
                        @foreach (PageService::getTemplatesAsOptions() as $template)
                            @if (! is_null(request('lang')) && request('lang') !== config('cms.default-language', 'en') && $page->translationData(request('lang')))
                                <option @if($template === $page->translationData(request('lang'))->template) selected  @endif value="{!! $template !!}">{!! ucfirst(str_replace('-template', '', $template)) !!}</option>
                            @else
                                <option @if($template === $page->template) selected  @endif value="{!! $template !!}">{!! ucfirst(str_replace('-template', '', $template)) !!}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                {!! FormMaker::setColumns(2)->fromObject($page->asObject(), Config::get('cms.forms.page.content')) !!}
                {!! FormMaker::setColumns(2)->fromObject($page->asObject(), Config::get('cms.forms.page.seo')) !!}
                {!! FormMaker::setColumns(2)->fromObject($page->asObject(), Config::get('cms.forms.page.publish')) !!}

                @include('cms::modules.pages.blocks', ['page' => $page->asObject()])

                <div class="form-group text-right">
                    <a href="{!! url(config('cms.backend-route-prefix', 'cms').'/pages') !!}" class="btn btn-secondary raw-left">Cancel</a>
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                </div>

            {!! Form::close() !!}
        </div>
        @if (config('cms.live-preview', false))
            <div class="col-md-6 hidden-sm hidden-xs">
                <div id="wrap">
                    @if (! is_null(request('lang')) && request('lang') !== config('cms.default-language', 'en'))
                        <iframe id="frame" src="{!! url(config('cms.backend-route-prefix', 'cms').'/preview/page/'.$page->id.'?lang='.request('lang')) !!}"></iframe>
                    @else
                        <iframe id="frame" src="{{ url(config('cms.backend-route-prefix', 'cms').'/preview/page/'.$page->id) }}"></iframe>
                    @endif
                </div>
                <div id="frameButtons" class="mt-2">
                    <button class="btn btn-secondary preview-toggle" data-platform="desktop">Desktop</button>
                    <button class="btn btn-secondary preview-toggle" data-platform="mobile">Mobile</button>
                </div>
            </div>
        @endif
    </div>

@endsection
