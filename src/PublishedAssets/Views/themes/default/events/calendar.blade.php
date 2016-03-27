@extends('quarx-frontend::layout.master')

@section('content')

<div class="container">

    <h1>Calendar</h1>

    <div class="row">
        <div class="col-md-12">
            {!! $calendar->asHtml([ 'class' => 'calendar', 'dates' => $events ]); !!}
            {!! $calendar->links('cal-link btn btn-default'); !!}
        </div>
    </div>

<div class="container">

@endsection

@section('quarx')
    @edit('events')
@endsection