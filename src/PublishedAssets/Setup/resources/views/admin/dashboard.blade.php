@extends('quarx::layouts.dashboard')

@section('content')

    <div class="row">
        @if (Session::get('original_user'))
            <a class="btn btn-default pull-right" href="/users/switch-back">Return to your Login</a>
        @endif
        <h1 class="page-header">Admin Dashboard</h1>
    </div>
    <div class="row">

    </div>

@stop
