@extends('quarx::layouts.dashboard')

@section('content')

    <div class="row">
        @if (! is_null(request('lang')) && request('lang') !== config('quarx.default-language', 'en') && $widgets->translationData(request('lang')))
            <a class="btn btn-warning pull-right raw-margin-left-8" href="{!! Quarx::rollbackUrl($widgets->translation(request('lang'))) !!}">Rollback</a>
        @elseif (is_null(request('lang')))
            <a class="btn btn-warning pull-right raw-margin-left-8" href="{!! Quarx::rollbackUrl($widgets) !!}">Rollback</a>
        @endif
        <h1 class="page-header">Widgets</h1>
    </div>

    @include('quarx::modules.widgets.breadcrumbs', ['location' => ['edit']])

    <div class="row raw-margin-bottom-24">
        <ul class="nav nav-tabs">
            @foreach(config('quarx.languages') as $short => $language)
                <li role="presentation" @if (request('lang') == $short || is_null(request('lang')) && $short == config('quarx.default-language'))) class="active" @endif><a href="{{ url(config('quarx.backend-route-prefix', 'quarx').'/widgets/'.$widgets->id.'/edit?lang='.$short) }}">{{ ucfirst($language) }}</a></li>
            @endforeach
        </ul>
    </div>

    <div class="row">
        {!! Form::model($widgets, ['route' => [config('quarx.backend-route-prefix', 'quarx').'.widgets.update', $widgets->id], 'method' => 'patch', 'class' => 'edit']) !!}

            <input type="hidden" name="lang" value="{{ request('lang') }}">

            @if (! is_null(request('lang')) && request('lang') !== config('quarx.default-language', 'en'))
                <input type="hidden" name="name" value="{{ $widgets->name }}">
                <input type="hidden" name="slug" value="{{ $widgets->slug }}">
                <div class="form-group">
                    {!! FormMaker::fromObject($widgets->translationData(request('lang')), ['content' => [
                        'type' => 'text',
                        'class' => 'redactor'
                    ]]) !!}
                </div>
            @else
                {!! FormMaker::fromObject($widgets, Config::get('quarx.forms.widget')) !!}
            @endif

            <div class="form-group text-right">
                <a href="{!! url(config('quarx.backend-route-prefix', 'quarx').'/widgets') !!}" class="btn btn-default raw-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection
