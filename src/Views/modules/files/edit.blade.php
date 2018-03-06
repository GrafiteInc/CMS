@extends('cabin::layouts.dashboard')

@section('content')

    <div class="row">
        <h1 class="page-header">Files</h1>
    </div>

    @include('cabin::modules.files.breadcrumbs', ['location' => ['edit']])

    <div class="row raw-margin-bottom-48 raw-margin-top-48 text-center">
        <a class="btn btn-default" href="{!! FileService::fileAsDownload($files->name, $files->location) !!}"><span class="fa fa-download"></span> Download: {!! $files->name !!}</a>
    </div>

    <div class="row">
        {!! Form::model($files, ['route' => [config('cabin.backend-route-prefix', 'cabin').'.files.update', $files->id], 'files' => true, 'method' => 'patch', 'class' => 'edit']) !!}

            {!! FormMaker::fromObject($files, Config::get('cabin.forms.file-edit')) !!}

            <div class="form-group text-right">
                <a href="{!! url(config('cabin.backend-route-prefix', 'cabin').'/files') !!}" class="btn btn-default raw-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection

@section('javascript')

    @parent
    {!! Minify::javascript(Cabin::asset('js/bootstrap-tagsinput.min.js', 'application/javascript')) !!}
    {!! Minify::javascript(Cabin::asset('packages/dropzone/dropzone.js', 'application/javascript')) !!}
    {!! Minify::javascript(Cabin::asset('js/files-module.js', 'application/javascript')) !!}
    {!! Minify::javascript(Cabin::asset('js/dropzone-custom.js', 'application/javascript')) !!}

@stop

