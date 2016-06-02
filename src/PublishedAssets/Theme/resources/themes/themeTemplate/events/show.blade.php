@extends('quarx-frontend::layout.master')

@section('seoDescription') {{ $event->seo_description }} @endsection
@section('seoKeywords') {{ $event->seo_keywords }} @endsection

@section('content')

    <h1>{!! $event->title !!}</h1>
    <p>{!! $event->start_date !!} - {!! $event->end_date !!}</p>
    {!! $event->details !!}

@endsection

@section('quarx')
    {!! Quarx::editBtn('events', $event->id) !!}
@endsection
