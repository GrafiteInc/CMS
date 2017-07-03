@extends('quarx::layouts.dashboard')

@section('content')

    <div class="row">
        <h1 class="page-header">Blog History</h1>
    </div>

    @include('quarx::modules.blogs.breadcrumbs', ['location' => [[$blog->title => url(config('quarx.backend-route-prefix', 'quarx').'/blog/'.$blog->id.'/edit')], 'history']])

    <div class="row">
        <table class="table table-striped">
        @foreach($blog->history() as $history)
            <tr>
                <td>{{ $history->created_at->format('M jS, Y') }} ({{ $history->created_at->diffForHumans() }})</td>
                <td class="text-right"><a class="btn btn-warning btn-link btn-xs" href="{{ url(config('quarx.backend-route-prefix', 'quarx').'revert/'.$history->id) }}">Revert</a></td>
            </tr>
        @endforeach
        </table>
    </div>

@endsection
