@extends('cms-frontend::layout.master')

@section('content')

    <div class="container">

        <h1 class="page-header">Events</h1>

        @foreach($events as $event)
            @if (config('app.locale') !== config('cms.default-language'))
                <a href="{!! url('events/event/'.$event->id) !!}">{{ $event->translationData(config('app.locale'))->title }}</a><br>
            @else
                <a href="{!! url('events/event/'.$event->id) !!}">{{ $event->title }}</a><br>
            @endif
        @endforeach

    </div>

@endsection

@section('cms')
    <li class="nav-text">@edit('events')</li>
@endsection