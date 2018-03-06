@extends('cabin::layouts.dashboard')

@section('content')

    <div class="row">
        @if (! is_null(request('lang')) && request('lang') !== config('cabin.default-language', 'en') && $event->translationData(request('lang')))
            @if (isset($event->translationData(request('lang'))->is_published))
                <a class="btn btn-default pull-right raw-margin-left-8" href="{!! url('events/event/'.$event->id) !!}">Live</a>
            @else
                <a class="btn btn-default pull-right raw-margin-left-8" href="{!! url(config('cabin.backend-route-prefix', 'cabin').'/preview/event/'.$event->id.'?lang='.request('lang')) !!}">Preview</a>
            @endif
            <a class="btn btn-warning pull-right raw-margin-left-8" href="{!! Cabin::rollbackUrl($event->translation(request('lang'))) !!}">Rollback</a>
        @else
            @if ($event->is_published)
                <a class="btn btn-default pull-right raw-margin-left-8" href="{!! url('events/event/'.$event->id) !!}">Live</a>
            @else
                <a class="btn btn-default pull-right raw-margin-left-8" href="{!! url(config('cabin.backend-route-prefix', 'cabin').'/preview/event/'.$event->id) !!}">Preview</a>
            @endif
            <a class="btn btn-warning pull-right raw-margin-left-8" href="{!! Cabin::rollbackUrl($event) !!}">Rollback</a>
            <a class="btn btn-default pull-right raw-margin-left-8" href="{!! url(config('cabin.backend-route-prefix', 'cabin').'/events/'.$event->id.'/history') !!}">History</a>
        @endif
        <h1 class="page-header">Events</h1>
    </div>

    @include('cabin::modules.events.breadcrumbs', ['location' => ['edit']])

    <div class="row raw-margin-bottom-24">
        <ul class="nav nav-tabs">
            @foreach(config('cabin.languages') as $short => $language)
                <li role="presentation" @if (request('lang') == $short || is_null(request('lang')) && $short == config('cabin.default-language'))) class="active" @endif><a href="{{ url(config('cabin.backend-route-prefix', 'cabin').'/events/'.$event->id.'/edit?lang='.$short) }}">{{ ucfirst($language) }}</a></li>
            @endforeach
        </ul>
    </div>

    <div class="row">
        <div class="@if (config('cabin.live-preview', false)) col-md-6 @endif">
            {!! Form::model($event, ['route' => [config('cabin.backend-route-prefix', 'cabin').'.events.update', $event->id], 'method' => 'patch', 'class' => 'edit']) !!}

                <div class="form-group">
                    <label for="Template">Template</label>
                    <select class="form-control" id="Template" name="template">
                        @foreach (EventService::getTemplatesAsOptions() as $template)
                            @if (! is_null(request('lang')) && request('lang') !== config('cabin.default-language', 'en') && $event->translationData(request('lang')))
                                <option @if($template === $event->translationData(request('lang'))->template) selected  @endif value="{!! $template !!}">{!! ucfirst(str_replace('-template', '', $template)) !!}</option>
                            @else
                                <option @if($template === $event->template) selected  @endif value="{!! $template !!}">{!! ucfirst(str_replace('-template', '', $template)) !!}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <input type="hidden" name="lang" value="{{ request('lang') }}">

                @if (! is_null(request('lang')) && request('lang') !== config('cabin.default-language', 'en'))
                    {!! FormMaker::fromObject($event->translationData(request('lang')), Config::get('cabin.forms.event')) !!}
                @else
                    {!! FormMaker::fromObject($event, Config::get('cabin.forms.event')) !!}
                @endif

                <div class="form-group text-right">
                    <a href="{!! url(config('cabin.backend-route-prefix', 'cabin').'/events') !!}" class="btn btn-default raw-left">Cancel</a>
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                </div>

            {!! Form::close() !!}
        </div>
        @if (config('cabin.live-preview', false))
            <div class="col-md-6 hidden-sm hidden-xs">
                <div id="wrap">
                    @if (! is_null(request('lang')) && request('lang') !== config('cabin.default-language', 'en'))
                        <iframe id="frame" src="{!! url(config('cabin.backend-route-prefix', 'cabin').'/preview/event/'.$event->id.'?lang='.request('lang')) !!}"></iframe>
                    @else
                        <iframe id="frame" src="{{ url(config('cabin.backend-route-prefix', 'cabin').'/preview/event/'.$event->id) }}"></iframe>
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
