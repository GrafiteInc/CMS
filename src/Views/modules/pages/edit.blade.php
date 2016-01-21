@extends('quarx::layouts.dashboard')

@section('content')

        <div class="row">
            @if ($page->is_published)
            <a class="btn btn-default pull-right raw-margin-left-8" href="{!! URL::to('page/'.$page->url) !!}">Live</a>
            @else
            <a class="btn btn-default pull-right raw-margin-left-8" href="{!! URL::to('quarx/preview/page/'.CryptoService::encrypt($page->id)) !!}">Preview</a>
            @endif
            <a class="btn btn-default pull-right raw-margin-left-8" href="{!! URL::to('quarx/rollback/page/'.CryptoService::encrypt($page->id)) !!}">Rollback</a>
            <h1 class="page-header">Pages</h1>
        </div>

        @include('quarx::modules.pages.breadcrumbs', ['location' => ['edit']])

        {!! Form::model($page, ['route' => ['quarx.pages.update', CryptoService::encrypt($page->id)], 'method' => 'patch']) !!}

            {!! FormMaker::fromObject($page, Config::get('quarx.forms.page')) !!}

            <div class="form-group text-right">
                <a href="{!! URL::to('quarx/pages') !!}" class="btn btn-default raw-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>
@endsection
