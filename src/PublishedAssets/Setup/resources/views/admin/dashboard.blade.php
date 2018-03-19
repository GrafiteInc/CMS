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
                    <span class="lead">{{ app(graphite\Quarx\Models\Blog::class)->count() }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="panel panel-default text-center">
                <div class="panel-heading">
                    Pages
                </div>
                <div class="panel-body">
                    <span class="lead">{{ app(graphite\Quarx\Models\Page::class)->count() }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="panel panel-default text-center">
                <div class="panel-heading">
                    Widgets
                </div>
                <div class="panel-body">
                    <span class="lead">{{ app(graphite\Quarx\Models\Widget::class)->count() }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="panel panel-default text-center">
                <div class="panel-heading">
                    Events
                </div>
                <div class="panel-body">
                    <span class="lead">{{ app(graphite\Quarx\Models\Event::class)->count() }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="panel panel-default text-center">
                <div class="panel-heading">
                    FAQs
                </div>
                <div class="panel-body">
                    <span class="lead">{{ app(graphite\Quarx\Models\FAQ::class)->count() }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <h2 class="text-center">Server</h2>
            <table class="table table-striped raw-margin-top-48">
                <tr>
                    <td>PHP Version</td>
                    <td class="text-right">{{ phpversion() }}</td>
                </tr>
                <tr>
                    <td>Server Address</td>
                    <td class="text-right">{{ request()->server('SERVER_ADDR') }}</td>
                </tr>
                <tr>
                    <td>Server Name</td>
                    <td class="text-right">{{ request()->server('SERVER_NAME') }}</td>
                </tr>
                <tr>
                    <td>Server Software</td>
                    <td class="text-right">{{ request()->server('SERVER_SOFTWARE') }}</td>
                </tr>
                <tr>
                    <td>Server Port</td>
                    <td class="text-right">{{ request()->server('SERVER_PORT') }}</td>
                </tr>
                <tr>
                    <td>Server Protocol</td>
                    <td class="text-right">{{ request()->server('SERVER_PROTOCOL') }}</td>
                </tr>
                <tr>
                    <td>Your Address</td>
                    <td class="text-right">{{ request()->server('REMOTE_ADDR') }}</td>
                </tr>
            </table>
        </div>
        <div class="col-md-6">
            <h2 class="text-center">Database</h2>
            <table class="table table-striped raw-margin-top-48">
                <tr>
                    <td>Type</td>
                    <td class="text-right">{{ ucfirst(app(Illuminate\Database\Connection::class)->getName()) }}</td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td class="text-right">{{ app(Illuminate\Database\Connection::class)->getDatabaseName() }}</td>
                </tr>
                @foreach (DB::select('SHOW VARIABLES LIKE "%version%";') as $dbVar)
                    <tr>
                        <td>{{ ucfirst(str_replace('_', ' ', $dbVar->Variable_name)) }}</td>
                        <td class="text-right">{{ $dbVar->Value }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

@stop
