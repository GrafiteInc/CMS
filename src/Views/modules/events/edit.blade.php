@extends('quarx::layouts.dashboard')

@section('content')

        <div class="row">
            @if ($event->is_published)
            <a class="btn btn-default pull-right raw-margin-left-8" href="{!! URL::to('events/event/'.$event->id) !!}">Live</a>
            @else
            <a class="btn btn-default pull-right raw-margin-left-8" href="{!! URL::to('quarx/preview/event/'.CryptoService::encrypt($event->id)) !!}">Preview</a>
            @endif
            <a class="btn btn-warning pull-right raw-margin-left-8" href="{!! URL::to('quarx/rollback/event/'.CryptoService::encrypt($event->id)) !!}">Rollback</a>
            <h1 class="page-header">Events</h1>
        </div>

        @include('quarx::modules.events.breadcrumbs', ['location' => ['edit']])

        {!! Form::model($event, ['route' => ['quarx.events.update', CryptoService::encrypt($event->id)], 'method' => 'patch']) !!}

            <div class="form-group">
                <label for="Template">Template</label>
                <select class="form-control" id="Template" name="template">
                    @foreach (EventService::getTemplatesAsOptions() as $template)
                        <option @if($template === $event->template) selected  @endif value="{!! $template !!}">{!! ucfirst(str_replace('-template', '', $template)) !!}</option>
                    @endforeach
                </select>
            </div>

            {!! FormMaker::fromObject($event, Config::get('quarx.forms.event')) !!}

            <div class="form-group text-right">
                <a href="{!! URL::to('quarx/events') !!}" class="btn btn-default raw-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>
@endsection
