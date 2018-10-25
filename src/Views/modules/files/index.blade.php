@extends('cms::layouts.dashboard')

@section('pageTitle') Files @stop

@section('content')

    <div class="modal fade" id="deleteModal" tabindex="-3" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="deleteModalLabel">Delete File</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete this file?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a id="deleteBtn" class="btn btn-danger" href="#">Confirm Delete</a>
                </div>
            </div>
        </div>
    </div>

    @include('cms::layouts.module-header', [ 'module' => 'files' ])

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                @if ($files->count() === 0)
                    @include('cms::layouts.module-search', [ 'module' => 'files' ])
                @else
                    <table class="table table-striped">
                        <thead>
                            <th>{!! sortable('Name', 'name') !!}</th>
                            <th class="m-hidden">{!! sortable('Is Published', 'is_published') !!}</th>
                            <th width="170px" class="text-right">Actions</th>
                        </thead>
                        <tbody>

                        @foreach($files as $file)
                            <tr>
                                <td>
                                    <a href="{!! Cms::fileAsDownload($file->name, $file->location) !!}"><span class="fa fa-download"></span></a>
                                    <a href="{!! route(cms()->route('files.edit'), [$file->id]) !!}">{!! $file->name !!}</a>
                                </td>
                                <td class="m-hidden">
                                    @if ($file->is_published)
                                        <span class="fa fa-check"></span>
                                    @else
                                        <span class="fa fa-times"></span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <div class="btn-toolbar justify-content-between">
                                        <a class="btn btn-sm btn-outline-primary ml-2" href="{!! route(cms()->route('files.edit'), [$file->id]) !!}"><i class="fa fa-edit"></i> Edit</a>
                                        <form method="post" action="{!! cms()->url('files/'.$file->id) !!}">
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

