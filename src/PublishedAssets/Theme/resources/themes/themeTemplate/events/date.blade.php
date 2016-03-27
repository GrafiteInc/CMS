@extends('quarx-frontend::layout.master')

@section('content')

    <h1>Events</h1>

    @foreach($events as $event)
        <a href="{!! url('events/event/'.$event->id) !!}">{{ $event->title }}</a><br>
    @endforeach

@endsection

@section('quarx')
    @edit('events')
@endsection