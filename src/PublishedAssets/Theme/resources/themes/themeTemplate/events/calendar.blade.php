@extends('cms-frontend::layout.master')

@section('content')

<div class="container">

    <div class="row">
        <div class="col-md-12 mb-4">
            {!! $calendar->asHtml([ 'class' => 'calendar', 'dates' => $events ]); !!}
            {!! $calendar->links('cal-link btn btn-secondary'); !!}
        </div>
    </div>

@endsection

@section('cms')
    <li class="nav-text">@edit('events')</li>
@endsection