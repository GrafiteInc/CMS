@extends('quarx::layouts.dashboard')

@section('content')

    <div class="row">
        <h1 class="page-header">Files</h1>
    </div>

    @include('quarx::modules.files.breadcrumbs', ['location' => ['edit']])

    <div class="row raw-margin-bottom-48 raw-margin-top-48 text-center">
        <a class="btn btn-default" href="{!! FileService::fileAsDownload($files->name, $files->location) !!}"><span class="fa fa-download"></span> Download: {!! $files->name !!}</a>
    </div>

    <div class="row">
        {!! Form::model($files, ['route' => [config('quarx.backend-route-prefix', 'quarx').'.files.update', $files->id], 'files' => true, 'method' => 'patch', 'class' => 'edit']) !!}

            {!! FormMaker::fromObject($files, Config::get('quarx.forms.file-edit')) !!}

            <div class="form-group text-right">
                <a href="{!! url(config('quarx.backend-route-prefix', 'quarx').'/files') !!}" class="btn btn-default raw-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection

@section('javascript')

    @parent
    {!! Minify::javascript(Quarx::asset('js/bootstrap-tagsinput.min.js', 'application/javascript')) !!}
    {!! Minify::javascript(Quarx::asset('packages/dropzone/dropzone.js', 'application/javascript')) !!}
    {!! Minify::javascript(Quarx::asset('js/files-module.js', 'application/javascript')) !!}
    {!! Minify::javascript(Quarx::asset('js/dropzone-custom.js', 'application/javascript')) !!}

@stop

