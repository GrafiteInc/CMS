@extends('cms::layouts.dashboard')

@section('content')

    <div class="row">
        <h1 class="page-header">Files</h1>
    </div>

    @include('cms::modules.files.breadcrumbs', ['location' => ['edit']])

    <div class="row raw-margin-bottom-48 raw-margin-top-48 text-center">
        <a class="btn btn-secondary" href="{!! Cms::fileAsDownload($files->name, $files->location) !!}"><span class="fa fa-download"></span> Download: {!! $files->name !!}</a>
    </div>

    <div class="row">
        {!! Form::model($files, ['route' => [config('cms.backend-route-prefix', 'cms').'.files.update', $files->id], 'files' => true, 'method' => 'patch', 'class' => 'edit']) !!}

            {!! FormMaker::fromObject($files, Config::get('cms.forms.file-edit')) !!}

            <div class="form-group text-right">
                <a href="{!! url(config('cms.backend-route-prefix', 'cms').'/files') !!}" class="btn btn-secondary raw-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection

@section('javascript')

    @parent
    {!! Minify::javascript(Cms::asset('js/bootstrap-tagsinput.min.js', 'application/javascript')) !!}
    {!! Minify::javascript(Cms::asset('packages/dropzone/dropzone.js', 'application/javascript')) !!}
    {!! Minify::javascript(Cms::asset('js/files-module.js', 'application/javascript')) !!}
    {!! Minify::javascript(Cms::asset('js/dropzone-custom.js', 'application/javascript')) !!}

@stop

