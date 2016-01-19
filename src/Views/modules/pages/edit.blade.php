@extends('quarx::layouts.dashboard')

@section('content')

        <div class="row">
            <h1 class="page-header">Pages</h1>
        </div>

        @include('quarx::modules.pages.breadcrumbs', ['location' => ['edit']])

        {!! Form::model($pages, ['route' => ['quarx.pages.update', CryptoService::encrypt($pages->id)], 'method' => 'patch']) !!}

            {!! FormMaker::fromObject($pages, Config::get('quarx.forms.page')) !!}

            <div class="form-group text-right">
                <a href="{!! URL::previous() !!}" class="btn btn-default raw-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>
@endsection
