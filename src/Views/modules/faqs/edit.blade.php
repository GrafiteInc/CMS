@extends('cabin::layouts.dashboard')

@section('content')

    <div class="row">
        @if (! is_null(request('lang')) && request('lang') !== config('cabin.default-language', 'en') && $faq->translationData(request('lang')))
            @if (isset($faq->translationData(request('lang'))->is_published))
                <a class="btn btn-default pull-right raw-margin-left-8" href="{!! url('faqs') !!}">Live</a>
            @endif
            <a class="btn btn-warning pull-right raw-margin-left-8" href="{!! Cabin::rollbackUrl($faq->translation(request('lang')))!!}">Rollback</a>
        @else
            @if ($faq->is_published)
                <a class="btn btn-default pull-right raw-margin-left-8" href="{!! url('faqs') !!}">Live</a>
            @endif
            <a class="btn btn-warning pull-right raw-margin-left-8" href="{!! Cabin::rollbackUrl($faq) !!}">Rollback</a>
        @endif

        <h1 class="page-header">FAQs</h1>
    </div>

    @include('cabin::modules.faqs.breadcrumbs', ['location' => ['edit']])

    <div class="row raw-margin-bottom-24">
        <ul class="nav nav-tabs">
            @foreach(config('cabin.languages') as $short => $language)
                <li role="presentation" @if (request('lang') == $short || is_null(request('lang')) && $short == config('cabin.default-language'))) class="active" @endif><a href="{{ url(config('cabin.backend-route-prefix', 'cabin').'/faqs/'.$faq->id.'/edit?lang='.$short) }}">{{ ucfirst($language) }}</a></li>
            @endforeach
        </ul>
    </div>

    <div class="row">
        {!! Form::model($faq, ['route' => [config('cabin.backend-route-prefix', 'cabin').'.faqs.update', $faq->id], 'method' => 'patch', 'class' => 'edit']) !!}

            <input type="hidden" name="lang" value="{{ request('lang') }}">

            @if (! is_null(request('lang')) && request('lang') !== config('cabin.default-language', 'en'))
                {!! FormMaker::fromObject($faq->translationData(request('lang')), Config::get('cabin.forms.faqs')) !!}
            @else
                {!! FormMaker::fromObject($faq, Config::get('cabin.forms.faqs')) !!}
            @endif

            <div class="form-group text-right">
                <a href="{!! url(config('cabin.backend-route-prefix', 'cabin').'/faqs') !!}" class="btn btn-default raw-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection
