@extends('cms::layouts.dashboard')

@section('pageTitle') Files @stop

@section('content')

    <div class="col-md-12 mt-2">
        @include('cms::modules.files.breadcrumbs', ['location' => ['edit']])
    </div>

    <div class="col-md-12 raw-margin-bottom-48 raw-margin-top-48 text-center">
        <a class="btn btn-secondary" href="{!! Cms::fileAsDownload($files->name, $files->location) !!}"><span class="fa fa-download"></span> Download: {!! $files->name !!}</a>
    </div>

    <div class="col-md-12">
        {!! Form::model($files, ['route' => [cms()->route('files.update'), $files->id], 'files' => true, 'method' => 'patch', 'class' => 'edit']) !!}

            {!! FormMaker::setColumns(2)->fromObject($files, config('cms.forms.file-edit')) !!}

            <div class="form-group text-right">
                <a href="{!! cms()->url('files') !!}" class="btn btn-secondary raw-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

@endsection
