@extends('quarx::layouts.dashboard')

@section('content')

    @include('quarx::modules.files.modals')

    @include('quarx::modules.files.menu', ['createBtn' => true])

    <div class="row">
        @if (isset($term))
            <div class="well text-center">Searched for "{!! $term !!}".</div>
        @endif
        @if ($files->count() === 0)
            <div class="well text-center">No files found.</div>
        @else
            <table class="table table-striped">
                <thead>
                    <th>Name</th>
                    <th class="raw-m-hide text-center">Published</th>
                    <th width="200px" class="text-right">Action</th>
                </thead>
                <tbody>

                @foreach($files as $file)
                    <tr>
                        <td>
                            <a href="{!! FileService::fileAsDownload($file->name, $file->location) !!}"><span class="fa fa-download"></span></a>
                            <a href="{!! route('quarx.files.edit', [$file->id]) !!}">{!! $file->name !!}</a>
                        </td>
                        <td class="raw-m-hide text-center">@if ($file->is_published) <span class="fa fa-check"></span> @else <span class="fa fa-close"></span> @endif</td>
                        <td class="text-right">
                            <form method="post" action="{!! url('quarx/files/'.$file->id) !!}">
                                {!! csrf_field() !!}
                                {!! method_field('DELETE') !!}
                                <button class="delete-btn btn btn-xs btn-danger pull-right" type="submit"><i class="fa fa-trash"></i> Delete</button>
                            </form>
                            <a class="btn btn-xs btn-default pull-right raw-margin-right-8" href="{!! route('quarx.files.edit', [$file->id]) !!}"><i class="fa fa-pencil"></i> Edit</a>
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

