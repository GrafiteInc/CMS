@extends('cabin::layouts.dashboard')

@section('content')
    <div class="row">
        <h1 class="page-header">Pages</h1>
    </div>

    @include('cabin::modules.pages.breadcrumbs', ['location' => ['create']])

    <div class="row">
        {!! Form::open(['route' => config('cabin.backend-route-prefix', 'cabin').'.pages.store', 'class' => 'add', 'files' => true]) !!}

            {!! FormMaker::fromTable('pages', Config::get('cabin.forms.page')) !!}

            <div class="form-group text-right">
                <a href="{!! url(config('cabin.backend-route-prefix', 'cabin').'/pages') !!}" class="btn btn-default raw-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>
@endsection
