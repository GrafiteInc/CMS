@extends('quarx::layouts.dashboard')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">Dashboard</h1>
            <div class="row">
                <canvas id="dashboardChart" class="raw100"></canvas>
            </div>
            <div class="row raw-margin-top-24">
                <div class="col-md-4">
                    <p class="lead">Top Browsers</p>
                    <table class="table table-striped">
                        <thead>
                            <th>Browser</th>
                            <th class="text-right">Views</th>
                        </thead>
                        <tbody>
                            @foreach($topBrowsers as $browser => $views)
                            <tr>
                                <td>{{ $browser }}</td>
                                <td class="text-right">{{ $views }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-4">
                    <p class="lead">Most Visited Pages</p>
                    <table class="table table-striped">
                        <thead>
                            <th>URL</th>
                            <th class="text-right">Views</th>
                        </thead>
                        <tbody>
                            @foreach($topPages as $url => $views)
                            <tr>
                                <td>{{ str_limit($url, 30) }}</td>
                                <td class="text-right">{{ $views }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-4">
                    <p class="lead">Top Referers</p>
                    <table class="table table-striped">
                        <thead>
                            <th>URL</th>
                            <th class="text-right">Views</th>
                        </thead>
                        <tbody>
                            @foreach($topReferers as $url => $views)
                            <tr>
                                <td>{{ str_limit($url, 40) }}</td>
                                <td class="text-right">{{ $views }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

@stop

@section('javascript')
    @parent
    <script type="text/javascript">
        var _chartData = {
            _labels : {!! json_encode($stats['dates']) !!},
            _visits : {!! json_encode($stats['visits']) !!}
        };
        var options = {};
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.bundle.js"></script>
    {!! Minify::javascript(Quarx::asset('js/dashboard-chart.js')) !!}
@stop