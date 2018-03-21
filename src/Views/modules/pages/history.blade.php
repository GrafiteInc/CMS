@extends('cms::layouts.dashboard')

@section('pageTitle') Page History @stop

@section('content')

    @include('cms::modules.pages.breadcrumbs', ['location' => [[$page->title => url(config('cms.backend-route-prefix', 'cms').'/pages/'.$page->id.'/edit')], 'history']])

    <div class="row mt-4">
        <div class="col-md-12">
            <table class="table table-striped">
                @foreach($page->history() as $history)
                    <tr>
                        <td>{{ $history->created_at->format('M jS, Y') }} ({{ $history->created_at->diffForHumans() }})</td>
                        <td class="text-right">
                            <a class="btn btn-outline-warning btn-sm" href="{{ url(config('cms.backend-route-prefix', 'cms').'/revert/'.$history->id) }}">Revert</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

@endsection
