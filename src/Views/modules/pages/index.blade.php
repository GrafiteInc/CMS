@extends('cms::layouts.dashboard')

@section('pageTitle') Pages @stop

@section('content')

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Page</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete this page?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a id="deleteBtn" class="btn btn-danger" href="#">Confirm Delete</a>
                </div>
            </div>
        </div>
    </div>

    @include('cms::layouts.module-header', [ 'module' => 'pages' ])

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                @if ($pages->count() === 0)
                    @include('cms::layouts.module-search', [ 'module' => 'pages' ])
                @else
                    <table class="table table-striped">
                        <thead>
                            <th>{!! sortable('Title', 'title') !!}</th>
                            <th class="m-hidden">{!! sortable('Url', 'url') !!}</th>
                            <th class="m-hidden">{!! sortable('Is Published', 'is_published') !!}</th>
                            <th width="170px" class="text-right">Actions</th>
                        </thead>
                        <tbody>
                            @foreach($pages as $page)
                                <tr>
                                    <td><a href="{!! route(cms()->route('pages.edit'), [$page->id]) !!}">{!! $page->title !!}</a></td>
                                    <td class="m-hidden">{!! $page->url !!}</td>
                                    <td class="m-hidden">
                                        @if ($page->is_published)
                                            <span class="fa fa-check"></span>
                                        @else
                                            <span class="fa fa-times"></span>
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <div class="btn-toolbar justify-content-between">
                                            <a class="btn btn-sm btn-outline-primary mr-2" href="{!! route(cms()->route('pages.edit'), [$page->id]) !!}"><i class="fa fa-edit"></i> Edit</a>
                                            <form method="post" action="{!! cms()->url('pages/'.$page->id) !!}">
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

            <div class="text-center">
                {!! $pagination !!}
            </div>
        </div>
    </div>

@endsection

