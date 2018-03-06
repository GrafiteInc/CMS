@extends('cabin::layouts.dashboard')

@section('content')

    <div class="row">
        <h1 class="page-header">Event History</h1>
    </div>

    @include('cabin::modules.events.breadcrumbs', ['location' => [[$event->title => url(config('cabin.backend-route-prefix', 'cabin').'/events/'.$event->id.'/edit')], 'history']])

    <div class="row">
        <table class="table table-striped">
        @foreach($event->history() as $history)
            <tr>
                <td>{{ $history->created_at->format('M jS, Y') }} ({{ $history->created_at->diffForHumans() }})</td>
                <td class="text-right"><a class="btn btn-warning btn-link btn-xs" href="{{ url(config('cabin.backend-route-prefix', 'cabin').'/revert/'.$history->id) }}">Revert</a></td>
            </tr>
        @endforeach
        </table>
    </div>

@endsection
