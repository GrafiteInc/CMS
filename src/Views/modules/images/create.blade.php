@extends('quarx::layouts.dashboard')

@section('content')

        <div class="row">
            <h1 class="page-header">Images</h1>
        </div>

        @include('quarx::modules.images.breadcrumbs', ['location' => ['create']])

        {!! Form::open(['route' => 'quarx.images.store', 'files' => true]) !!}

            {!! FormMaker::fromTable('images', Config::get('quarx.forms.images')) !!}

            <div class="form-group text-right">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}

@endsection
