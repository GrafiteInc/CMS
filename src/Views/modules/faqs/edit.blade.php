@extends('cms::layouts.dashboard')

@section('content')

    <div class="row">
        @if (! is_null(request('lang')) && request('lang') !== config('cms.default-language', 'en') && $faq->translationData(request('lang')))
            @if (isset($faq->translationData(request('lang'))->is_published))
                <a class="btn btn-default pull-right raw-margin-left-8" href="{!! url('faqs') !!}">Live</a>
            @endif
            <a class="btn btn-warning pull-right raw-margin-left-8" href="{!! Cms::rollbackUrl($faq->translation(request('lang')))!!}">Rollback</a>
        @else
            @if ($faq->is_published)
                <a class="btn btn-default pull-right raw-margin-left-8" href="{!! url('faqs') !!}">Live</a>
            @endif
            <a class="btn btn-warning pull-right raw-margin-left-8" href="{!! Cms::rollbackUrl($faq) !!}">Rollback</a>
        @endif

        <h1 class="page-header">FAQs</h1>
    </div>

    @include('cms::modules.faqs.breadcrumbs', ['location' => ['edit']])

    <div class="row raw-margin-bottom-24">
        <ul class="nav nav-tabs">
            @foreach(config('cms.languages') as $short => $language)
                <li role="presentation" @if (request('lang') == $short || is_null(request('lang')) && $short == config('cms.default-language'))) class="active" @endif><a href="{{ url(config('cms.backend-route-prefix', 'cms').'/faqs/'.$faq->id.'/edit?lang='.$short) }}">{{ ucfirst($language) }}</a></li>
            @endforeach
        </ul>
    </div>

    <div class="row">
        {!! Form::model($faq, ['route' => [config('cms.backend-route-prefix', 'cms').'.faqs.update', $faq->id], 'method' => 'patch', 'class' => 'edit']) !!}

            <input type="hidden" name="lang" value="{{ request('lang') }}">

            @if (! is_null(request('lang')) && request('lang') !== config('cms.default-language', 'en'))
                {!! FormMaker::fromObject($faq->translationData(request('lang')), Config::get('cms.forms.faqs')) !!}
            @else
                {!! FormMaker::fromObject($faq, Config::get('cms.forms.faqs')) !!}
            @endif

            <div class="form-group text-right">
                <a href="{!! url(config('cms.backend-route-prefix', 'cms').'/faqs') !!}" class="btn btn-default raw-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection
