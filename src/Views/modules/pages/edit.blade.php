@extends('quarx::layouts.dashboard')

@section('content')

    <div class="row">
        @if (! is_null(request('lang')) && request('lang') !== config('quarx.default-language', 'en') && $page->translationData(request('lang')))
            @if (isset($page->translationData(request('lang'))->is_published))
                <a class="btn btn-default pull-right raw-margin-left-8" href="{!! URL::to('page/'.$page->translationData(request('lang'))->url) !!}">Live</a>
            @else
                <a class="btn btn-default pull-right raw-margin-left-8" href="{!! URL::to('quarx/preview/page/'.$page->id.'?lang='.request('lang')) !!}">Preview</a>
            @endif
             <a class="btn btn-warning pull-right raw-margin-left-8" href="{!! URL::to('quarx/rollback/translation/'.$page->translation(request('lang'))->id) !!}">Rollback</a>
        @else
            @if ($page->is_published)
                <a class="btn btn-default pull-right raw-margin-left-8" href="{!! URL::to('page/'.$page->url) !!}">Live</a>
            @else
                <a class="btn btn-default pull-right raw-margin-left-8" href="{!! URL::to('quarx/preview/page/'.$page->id) !!}">Preview</a>
            @endif
            <a class="btn btn-warning pull-right raw-margin-left-8" href="{!! URL::to('quarx/rollback/page/'.$page->id) !!}">Rollback</a>
        @endif

        <h1 class="page-header">Pages</h1>
    </div>

    @include('quarx::modules.pages.breadcrumbs', ['location' => ['edit']])

    <div class="row raw-margin-bottom-24">
        <ul class="nav nav-tabs">
            @foreach(config('quarx.languages', Quarx::config('quarx.languages')) as $short => $language)
                <li role="presentation" @if (request('lang') == $short || is_null(request('lang')) && $short == Quarx::config('quarx.default-language'))) class="active" @endif><a href="{{ url('quarx/pages/'.$page->id.'/edit?lang='.$short) }}">{{ ucfirst($language) }}</a></li>
            @endforeach
        </ul>
    </div>

    <div class="row">
        {!! Form::model($page, ['route' => ['quarx.pages.update', $page->id], 'method' => 'patch', 'class' => 'edit']) !!}

            <input type="hidden" name="lang" value="{{ request('lang') }}">

            <div class="form-group">
                <label for="Template">Template</label>
                <select class="form-control" id="Template" name="template">
                    @foreach (PageService::getTemplatesAsOptions() as $template)

                        @if (! is_null(request('lang')) && request('lang') !== config('quarx.default-language', 'en') && $page->translationData(request('lang')))
                            <option @if($template === $page->translationData(request('lang'))->template) selected  @endif value="{!! $template !!}">{!! ucfirst(str_replace('-template', '', $template)) !!}</option>
                        @else
                            <option @if($template === $page->template) selected  @endif value="{!! $template !!}">{!! ucfirst(str_replace('-template', '', $template)) !!}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            @if (! is_null(request('lang')) && request('lang') !== config('quarx.default-language', 'en'))
                {!! FormMaker::fromObject($page->translationData(request('lang')), Config::get('quarx.forms.page')) !!}
            @else
                {!! FormMaker::fromObject($page, Config::get('quarx.forms.page')) !!}
            @endif

            <div class="form-group text-right">
                <a href="{!! URL::to('quarx/pages') !!}" class="btn btn-default raw-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection
