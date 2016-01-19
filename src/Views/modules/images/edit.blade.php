@extends('quarx::layouts.dashboard')

@section('content')

        <div class="row">
            <h1 class="page-header">Images</h1>
        </div>

        @include('quarx::modules.images.breadcrumbs', ['location' => ['edit']])

        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="thumbnail ">
                    <img src="{!! FileService::filePreview($images->location) !!}" />
                </div>
            </div>
        </div>

        {!! Form::model($images, ['route' => ['quarx.images.update', CryptoService::encrypt($images->id)], 'method' => 'patch', 'files' => true]) !!}

            {!! FormMaker::fromObject($images, Config::get('quarx.forms.images')) !!}

            <div class="form-group text-right">
                <a class="btn btn-default pull-left" href="{!! URL::to(URL::previous()) !!}">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
@endsection
