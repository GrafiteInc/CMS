@extends('quarx-frontend::layout.master')

@section('seoDescription') {{ $event->seo_description }} @endsection
@section('seoKeywords') {{ $event->seo_keywords }} @endsection

@section('content')

<div class="container">

    <div class="jumbotron">
        <h1>Featured Event</h1>
        <h2>{{ $event->title }}</h2>
    </div>

    <p>{!! $event->start_date !!} - {!! $event->end_date !!}</p>
    {!! $event->details !!}

</div>

@endsection

@section('quarx')
    @edit('events', $event->id)
@endsection
