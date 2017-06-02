@extends('quarx::layouts.dashboard')

@section('content')

    <div class="row">
        @if (! is_null(request('lang')) && request('lang') !== config('quarx.default-language', 'en') && $faq->translationData(request('lang')))
            @if (isset($faq->translationData(request('lang'))->is_published))
                <a class="btn btn-default pull-right raw-margin-left-8" href="{!! url('faqs') !!}">Live</a>
            @endif
            <a class="btn btn-warning pull-right raw-margin-left-8" href="{!! Quarx::rollbackUrl($faq->translation(request('lang')))!!}">Rollback</a>
        @else
            @if ($faq->is_published)
                <a class="btn btn-default pull-right raw-margin-left-8" href="{!! url('faqs') !!}">Live</a>
            @endif
            <a class="btn btn-warning pull-right raw-margin-left-8" href="{!! Quarx::rollbackUrl($faq) !!}">Rollback</a>
        @endif

        <h1 class="page-header">FAQs</h1>
    </div>

    @include('quarx::modules.faqs.breadcrumbs', ['location' => ['edit']])

    <div class="row raw-margin-bottom-24">
        <ul class="nav nav-tabs">
            @foreach(config('quarx.languages') as $short => $language)
                <li role="presentation" @if (request('lang') == $short || is_null(request('lang')) && $short == config('quarx.default-language'))) class="active" @endif><a href="{{ url(config('quarx.backend-route-prefix', 'quarx').'/faqs/'.$faq->id.'/edit?lang='.$short) }}">{{ ucfirst($language) }}</a></li>
            @endforeach
        </ul>
    </div>

    <div class="row">
        {!! Form::model($faq, ['route' => [config('quarx.backend-route-prefix', 'quarx').'.faqs.update', $faq->id], 'method' => 'patch', 'class' => 'edit']) !!}

            <input type="hidden" name="lang" value="{{ request('lang') }}">

            @if (! is_null(request('lang')) && request('lang') !== config('quarx.default-language', 'en'))
                {!! FormMaker::fromObject($faq->translationData(request('lang')), Config::get('quarx.forms.faqs')) !!}
            @else
                {!! FormMaker::fromObject($faq, Config::get('quarx.forms.faqs')) !!}
            @endif

            <div class="form-group text-right">
                <a href="{!! url(config('quarx.backend-route-prefix', 'quarx').'/faqs') !!}" class="btn btn-default raw-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection
