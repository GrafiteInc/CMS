@extends('quarx-frontend::layout.master')

@section('content')

<div class="container">

    <h1>Events</h1>

    @foreach($events as $event)
        <a href="{!! url('events/event/'.$event->id) !!}">{{ $event->title }}</a><br>
    @endforeach

</div>

@endsection

@section('quarx')
    @('events')
@endsection