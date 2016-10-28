@extends('quarx::layouts.dashboard')

@section('content')

    <div class="modal fade" id="deleteModal" tabindex="-3" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="deleteModalLabel">Delete Event</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete this event?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a id="deleteBtn" type="button" class="btn btn-warning" href="#">Confirm Delete</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <a class="btn btn-primary pull-right" href="{!! route('quarx.events.create') !!}">Add New</a>
        <div class="raw-m-hide pull-right">
            {!! Form::open(['url' => 'quarx/events/search']) !!}
            <input class="form-control header-input pull-right raw-margin-right-24" name="term" placeholder="Search">
            {!! Form::close() !!}
        </div>
        <h1 class="page-header">Events</h1>
    </div>

    <div class="row">
        @if (isset($term))
        <div class="well text-center">Searched for "{!! $term !!}".</div>
        @endif
        @if($events->count() === 0)
            <div class="well text-center">No events found.</div>
        @else
            <table class="table table-striped">
                <thead>
                    <th>Title</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th class="raw-m-hide text-center">Is Published</th>
                    <th width="200px" class="text-right">Actions</th>
                </thead>
                <tbody>

                @foreach($events as $event)
                    <tr>
                        <td><a href="{!! route('quarx.events.edit', [$event->id]) !!}">{!! $event->title !!}</a></td>
                        <td>{!! date('M jS, Y', strtotime($event->start_date)) !!}</td>
                        <td>{!! date('M jS, Y', strtotime($event->end_date)) !!}</td>
                        <td class="raw-m-hide text-center">
                            @if ($event->is_published)
                                <span class="fa fa-check"></span>
                            @else
                                <span class="fa fa-close"></span>
                            @endif
                        </td>
                        <td class="text-right">
                            <form method="post" action="{!! url('quarx/events/'.$event->id) !!}">
                                {!! csrf_field() !!}
                                {!! method_field('DELETE') !!}
                                <button class="delete-btn btn btn-xs btn-danger pull-right" type="submit"><i class="fa fa-trash"></i> Delete</button>
                            </form>
                            <a class="btn btn-xs btn-default pull-right raw-margin-right-8" href="{!! route('quarx.events.edit', [$event->id]) !!}"><i class="fa fa-pencil"></i> Edit</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>

    {!! $pagination !!}

@endsection
