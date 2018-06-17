@extends('cms::layouts.dashboard')

@section('pageTitle') Events @stop

@section('content')

    <div class="modal fade" id="deleteModal" tabindex="-3" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="deleteModalLabel">Delete Event</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete this event?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a id="deleteBtn" class="btn btn-danger" href="#">Confirm Delete</a>
                </div>
            </div>
        </div>
    </div>

    @include('cms::layouts.module-header', [ 'module' => 'events' ])

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                @if ($events->count() === 0)
                    @include('cms::layouts.module-search', [ 'module' => 'events' ])
                @else
                    <table class="table table-striped">
                        <thead>
                            <th>{!! sortable('Title', 'title') !!}</th>
                            <th class="m-hidden">{!! sortable('Start Date', 'start_date') !!}</th>
                            <th class="m-hidden">{!! sortable('End Date', 'end_date') !!}</th>
                            <th class="m-hidden">{!! sortable('Published', 'is_published') !!}</th>
                            <th width="170px" class="text-right">Actions</th>
                        </thead>
                        <tbody>

                        @foreach($events as $event)
                            <tr>
                                <td><a href="{!! route(cms()->route('events.edit'), [$event->id]) !!}">{!! $event->title !!}</a></td>
                                <td class="m-hidden">{!! date('M jS, Y', strtotime($event->start_date)) !!}</td>
                                <td class="m-hidden">{!! date('M jS, Y', strtotime($event->end_date)) !!}</td>
                                <td class="m-hidden">
                                    @if ($event->is_published)
                                        <span class="fa fa-check"></span>
                                    @else
                                        <span class="fa fa-times"></span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <div class="btn-toolbar justify-content-between">
                                        <a class="btn btn-sm btn-outline-primary mr-2" href="{!! route(cms()->route('events.edit'), [$event->id]) !!}"><i class="fa fa-edit"></i> Edit</a>
                                        <form method="post" action="{!! cms()->url('events/'.$event->id) !!}">
                                            {!! csrf_field() !!}
                                            {!! method_field('DELETE') !!}
                                            <button class="delete-btn btn btn-sm btn-danger" type="submit"><i class="fa fa-trash"></i> Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
    <div class="text-center">
        {!! $pagination !!}
    </div>

@endsection
