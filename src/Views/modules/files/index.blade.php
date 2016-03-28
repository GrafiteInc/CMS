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
                        <th width="50px">Action</th>
                    </thead>
                    <tbody>

                    @foreach($files as $file)
                        <tr>
                            <td>
                                <a href="{!! FileService::fileAsDownload($file->name, $file->location) !!}"><span class="fa fa-download"></span></a>
                                <a href="{!! route('quarx.files.edit', [CryptoService::encrypt($file->id)]) !!}">{!! $file->name !!}</a>
                            </td>
                            <td class="raw-m-hide text-center">@if ($file->is_published) <span class="fa fa-check"></span> @else <span class="fa fa-close"></span> @endif</td>
                            <td class="text-right">
                                <a href="{!! route('quarx.files.edit', [CryptoService::encrypt($file->id)]) !!}"><i class="text-info glyphicon glyphicon-edit"></i></a>
                                <a href="#" onclick="confirmDelete('{!! route('quarx.files.delete', [CryptoService::encrypt($file->id)]) !!}')"><i class="text-danger glyphicon glyphicon-remove"></i></a>
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

