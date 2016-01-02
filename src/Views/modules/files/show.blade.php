@extends('gondolyn.layouts.dashboard')

@section('content')

    <div class="col-sm-3 col-md-2 sidebar">
        <div class="raw100 raw-left raw-margin-bottom-90">
            @include('gondolyn.dashboard.panel')
        </div>
    </div>

    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div class="container raw-margin-top-24">
        </div>
    </div>

@endsection
