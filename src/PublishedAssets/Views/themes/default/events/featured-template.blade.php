@extends('quarx-frontend::layout.master')

@section('content')

    <div class="jumbotron">
        <h1>Featured Event</h1>
        <h2>{{ $event->title }}</h2>
    </div>

    <p>{!! $event->start_date !!} - {!! $event->end_date !!}</p>
    {!! $event->details !!}

@endsection

@section('quarx')
    {!! Quarx::editBtn('events', $event->id) !!}
@endsection
