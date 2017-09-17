@extends('quarx::layouts.dashboard')

@section('content')

    <div class="row">
        @if (Session::get('original_user'))
            <a class="btn btn-default pull-right" href="/users/switch-back">Return to your Login</a>
        @endif
        <h1 class="page-header">Admin Dashboard</h1>
    </div>
    <div class="row">
        <div class="col-lg-2">
            <div class="panel panel-default text-center">
                <div class="panel-heading">
                    Users
                </div>
                <div class="panel-body">
                    <span class="lead">{{ app(App\Models\User::class)->count() }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="panel panel-default text-center">
                <div class="panel-heading">
                    Blogs
                </div>
                <div class="panel-body">
                    <span class="lead">{{ app(Yab\Quarx\Models\Blog::class)->count() }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="panel panel-default text-center">
                <div class="panel-heading">
                    Pages
                </div>
                <div class="panel-body">
                    <span class="lead">{{ app(Yab\Quarx\Models\Page::class)->count() }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="panel panel-default text-center">
                <div class="panel-heading">
                    Widgets
                </div>
                <div class="panel-body">
                    <span class="lead">{{ app(Yab\Quarx\Models\Widget::class)->count() }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="panel panel-default text-center">
                <div class="panel-heading">
                    Events
                </div>
                <div class="panel-body">
                    <span class="lead">{{ app(Yab\Quarx\Models\Event::class)->count() }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="panel panel-default text-center">
                <div class="panel-heading">
                    FAQs
                </div>
                <div class="panel-body">
                    <span class="lead">{{ app(Yab\Quarx\Models\FAQ::class)->count() }}</span>
                </div>
            </div>
        </div>
    </div>

@stop
