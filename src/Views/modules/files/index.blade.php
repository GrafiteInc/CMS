@extends('quarx::layouts.dashboard')

@section('content')

    <div class="modal fade" id="deleteModal" tabindex="-3" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="deleteModalLabel">Delete File</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete this file?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a id="deleteBtn" type="button" class="btn btn-warning" href="#">Confirm Delete</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <a class="btn btn-primary pull-right" href="{!! route(config('quarx.backend-route-prefix', 'quarx').'.files.create') !!}">Add New</a>
        <div class="raw-m-hide pull-right raw-m-hide">
            {!! Form::open(['url' => 'quarx/files/search']) !!}
            <input class="form-control header-input pull-right raw-margin-right-24" name="term" placeholder="Search">
            {!! Form::close() !!}
        </div>
        <h1 class="page-header">Files</h1>
    </div>

    <div class="row">
        @if (isset($term))
            <div class="well text-center">Searched for "{!! $term !!}".</div>
        @endif
        @if ($files->count() === 0)
            <div class="well text-center">No files found.</div>
        @else
            <table class="table table-striped">
                <thead>
                    <th>{!! sortable('Name', 'name') !!}</th>
                    <th>{!! sortable('Is Published', 'is_published') !!}</th>
                    <th width="200px" class="text-right">Actions</th>
                </thead>
                <tbody>

                @foreach($files as $file)
                    <tr>
                        <td>
                            <a href="{!! FileService::fileAsDownload($file->name, $file->location) !!}"><span class="fa fa-download"></span></a>
                            <a href="{!! route(config('quarx.backend-route-prefix', 'quarx').'.files.edit', [$file->id]) !!}">{!! $file->name !!}</a>
                        </td>
                        <td class="raw-m-hide">@if ($file->is_published) <span class="fa fa-check"></span> @else <span class="fa fa-close"></span> @endif</td>
                        <td class="text-right">
                            <form method="post" action="{!! url(config('quarx.backend-route-prefix', 'quarx').'/files/'.$file->id) !!}">
                                {!! csrf_field() !!}
                                {!! method_field('DELETE') !!}
                                <button class="delete-btn btn btn-xs btn-danger pull-right" type="submit"><i class="fa fa-trash"></i> Delete</button>
                            </form>
                            <a class="btn btn-xs btn-default pull-right raw-margin-right-8" href="{!! route(config('quarx.backend-route-prefix', 'quarx').'.files.edit', [$file->id]) !!}"><i class="fa fa-pencil"></i> Edit</a>
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

@endsection

@section('javascript')

@parent
{!! Minify::javascript( Quarx::asset('js/bootstrap-tagsinput.min.js', 'application/javascript') ) !!}
{!! Minify::javascript( Quarx::asset('dropzone/dropzone.js', 'application/javascript') ) !!}
{!! Minify::javascript( Quarx::asset('js/files-module.js', 'application/javascript') ) !!}
{!! Minify::javascript( Quarx::asset('js/dropzone-custom.js', 'application/javascript') ) !!}

@stop

