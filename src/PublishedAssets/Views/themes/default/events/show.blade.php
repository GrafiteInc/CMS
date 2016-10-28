@extends('quarx-frontend::layout.master')

@section('seoDescription') {{ $event->seo_description }} @endsection
@section('seoKeywords') {{ $event->seo_keywords }} @endsection

@section('content')

<div class="container">

    @if (config('app.locale') !== config('quarx.default-language'))
        <h1>{!! $event->translationData(config('app.locale'))->title !!}</h1>
        <p>{!! $event->translationData(config('app.locale'))->start_date !!} - {!! $event->translationData(config('app.locale'))->end_date !!}</p>
        {!! $event->translationData(config('app.locale'))->details !!}
    @else
        <h1>{!! $event->title !!}</h1>
        <p>{!! $event->start_date !!} - {!! $event->end_date !!}</p>
        {!! $event->details !!}
    @endif

</div>

@endsection

@section('quarx')
    @edit('events', $event->id)
@endsection
