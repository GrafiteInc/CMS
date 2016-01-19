@extends('quarx::layouts.dashboard')

@section('content')

        @include('quarx::modules.files.menu')

        @include('quarx::modules.files.breadcrumbs', ['location' => ['edit']])

        <div class="row raw-margin-bottom-48 raw-margin-top-48 text-center">
            <a class="btn btn-default" href="{!! FileService::fileAsDownload($files->location, $files->location) !!}"><span class="fa fa-download"></span> Download: {!! $files->name !!}</a>
        </div>

        {!! Form::model($files, ['route' => ['quarx.files.update', CryptoService::encrypt($files->id)], 'files' => true, 'method' => 'patch']) !!}

            {!! FormMaker::fromObject($files, Config::get('quarx.forms.file-edit')) !!}

            <div class="form-group text-right">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}

@endsection

@section('javascript')

    @parent
    {!! Minify::javascript(Quarx::asset('js/bootstrap-tagsinput.min.js', 'application/javascript')) !!}
    {!! Minify::javascript(Quarx::asset('packages/dropzone/dropzone.js', 'application/javascript')) !!}
    {!! Minify::javascript(Quarx::asset('js/files-module.js', 'application/javascript')) !!}
    {!! Minify::javascript(Quarx::asset('js/dropzone-custom.js', 'application/javascript')) !!}

@stop

