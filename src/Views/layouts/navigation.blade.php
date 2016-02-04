@extends('quarx::layouts.master')

@section('navigation')

<div class="raw100 raw-left navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainNavbar">
            <span class="sr-only">Quarx</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <span class="navbar-brand"><span class="fa fa-cogs"></span> Quarx</span>
        @if (Auth::user())
        <p class="navbar-text navbar-left">Signed in as {{ Auth::user()->name }}</p>
        @endif
    </div>
    <div class="collapse navbar-collapse navbar-right" id="mainNavbar">
        <ul class="nav navbar-nav">
            <li><a href="{{ URL::to('/') }}"><span class="fa fa-arrow-left"></span> Back To Site </a></li>
            @if (Auth::user())
            <li><a href="/logout">Logout</a></li>
            @endif
        </ul>
    </div>
</div>

@stop