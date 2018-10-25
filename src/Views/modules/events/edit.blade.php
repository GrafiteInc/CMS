@extends('cms::layouts.dashboard')

@section('pageTitle') Events @stop

@section('content')

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6 mt-2">
                @include('cms::modules.events.breadcrumbs', ['location' => ['edit']])
            </div>
            <div class="col-md-6">
                <div class="btn-toolbar float-right mt-2 mb-4">
                    @if (! cms()->isDefaultLanguage() && $event->translationData(request('lang')))
                        @if (isset($event->translationData(request('lang'))->is_published))
                            <a class="btn btn-success ml-1" href="{!! url('events/event/'.$event->id) !!}">Live</a>
                        @else
                            <a class="btn btn-success ml-1" href="{!! cms()->url('preview/event/'.$event->id.'?lang='.request('lang')) !!}">Preview</a>
                        @endif
                        <a class="btn btn-warning ml-1" href="{!! Cms::rollbackUrl($event->translation(request('lang'))) !!}">Rollback</a>
                    @else
                        @if ($event->is_published)
                            <a class="btn btn-success ml-1" href="{!! url('events/event/'.$event->id) !!}">Live</a>
                        @else
                            <a class="btn btn-secondary ml-1" href="{!! cms()->url('preview/event/'.$event->id) !!}">Preview</a>
                        @endif
                        <a class="btn btn-warning ml-1" href="{!! Cms::rollbackUrl($event) !!}">Rollback</a>
                        <a class="btn btn-outline-secondary ml-1" href="{!! cms()->url('events/'.$event->id.'/history') !!}">History</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="row mb-4">
            <div class="col-md-12">
                <ul class="nav nav-tabs">
                    @include('cms::layouts.tabs', [ 'module' => 'events', 'item' => $event ])
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="@if (config('cms.live-preview', false)) col-md-6 @else col-md-12 @endif">
                {!! Form::model($event, ['route' => [cms()->route('events.update'), $event->id], 'method' => 'patch', 'class' => 'edit']) !!}

                    <div class="form-group">
                        <label for="Template">Template</label>
                        <select class="form-control" id="Template" name="template">
                            @foreach (EventService::getTemplatesAsOptions() as $template)
                                @if (! cms()->isDefaultLanguage() && $event->translationData(request('lang')))
                                    <option @if($template === $event->translationData(request('lang'))->template) selected  @endif value="{!! $template !!}">{!! ucfirst(str_replace('-template', '', $template)) !!}</option>
                                @else
                                    <option @if($template === $event->template) selected  @endif value="{!! $template !!}">{!! ucfirst(str_replace('-template', '', $template)) !!}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <input type="hidden" name="lang" value="{{ request('lang') }}">

                    {!! FormMaker::setColumns(3)->fromObject($event->asObject(), config('cms.forms.event.identity')) !!}
                    {!! FormMaker::setColumns(1)->fromObject($event->asObject(), config('cms.forms.event.content')) !!}
                    {!! FormMaker::setColumns(2)->fromObject($event->asObject(), config('cms.forms.event.seo')) !!}
                    {!! FormMaker::setColumns(2)->fromObject($event->asObject(), config('cms.forms.event.publish')) !!}

                    <div class="form-group text-right">
                        <a href="{!! cms()->url('events') !!}" class="btn btn-secondary float-left">Cancel</a>
                        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                    </div>

                {!! Form::close() !!}
            </div>
            @if (config('cms.live-preview', false))
                <div class="col-md-6 hidden-sm hidden-xs">
                    <div id="wrap">
                        @if (! cms()->isDefaultLanguage())
                            <iframe id="frame" src="{!! cms()->url('preview/event/'.$event->id.'?lang='.request('lang')) !!}"></iframe>
                        @else
                            <iframe id="frame" src="{{ cms()->url('preview/event/'.$event->id) }}"></iframe>
                        @endif
                    </div>
                    <div id="frameButtons" class="raw-margin-top-16">
                        <button class="btn btn-secondary preview-toggle" data-platform="desktop">Desktop</button>
                        <button class="btn btn-secondary preview-toggle" data-platform="mobile">Mobile</button>
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection
