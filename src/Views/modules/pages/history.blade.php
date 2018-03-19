@extends('cms::layouts.dashboard')

@section('content')

    <div class="row">
        <h1 class="page-header">Page History</h1>
    </div>

    @include('cms::modules.pages.breadcrumbs', ['location' => [[$page->title => url(config('cms.backend-route-prefix', 'cms').'/pages/'.$page->id.'/edit')], 'history']])

    <div class="row">
        <table class="table table-striped">
        @foreach($page->history() as $history)
            <tr>
                <td>{{ $history->created_at->format('M jS, Y') }} ({{ $history->created_at->diffForHumans() }})</td>
                <td class="text-right"><a class="btn btn-warning btn-link btn-xs" href="{{ url(config('cms.backend-route-prefix', 'cms').'/revert/'.$history->id) }}">Revert</a></td>
            </tr>
        @endforeach
        </table>
    </div>

@endsection
