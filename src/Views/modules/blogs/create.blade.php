@extends('cms::layouts.dashboard')

@section('pageTitle') Blog @stop

@section('content')

    <div class="col-md-12 mt-2">
        @include('cms::modules.blogs.breadcrumbs', ['location' => ['create']])
    </div>
    <div class="col-md-12">

        {!! $form !!}

    </div>

@endsection
