@extends('quarx-frontend::layout.master')

@section('seoDescription') {{ $event->seo_description }} @endsection
@section('seoKeywords') {{ $event->seo_keywords }} @endsection

@section('content')

<div class="container">

    <h1>{!! $event->title !!}</h1>
    <p>{!! $event->start_date !!} - {!! $event->end_date !!}</p>
    {!! $event->details !!}

</div>

@endsection

@section('quarx')
    @edit('events', $event->id)
@endsection
