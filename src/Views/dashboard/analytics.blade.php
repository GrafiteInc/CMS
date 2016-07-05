@extends('quarx::layouts.dashboard')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">Dashboard</h1>

            <div class="row">
                <canvas id="dashboardChart" class="raw100"></canvas>
            </div>

            <div class="row raw-margin-top-24">
                <div class="col-md-6">
                    <p class="lead">Keywords</p>
                    <table class="table table-striped">
                        <thead>
                            <th>Keyword</th>
                            <th>Sessions</th>
                        </thead>
                        @foreach (Analytics::getTopKeywords(365, 10) as $word)
                            <tr>
                                <td>{{ $word['keyword'] }}</td>
                                <td>{{ $word['sessions'] }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="col-md-6">
                    <p class="lead">Most Visited Pages</p>
                    <table class="table table-striped">
                        <thead>
                            <th>URL</th>
                            <th>Views</th>
                        </thead>
                        @foreach (Analytics::getMostVisitedPages(365, 10) as $browser)
                            <tr>
                                <td>{{ $browser['url'] }}</td>
                                <td>{{ $browser['pageViews'] }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>

            <div class="row raw-margin-top-24">
                <div class="col-md-6">
                    <p class="lead">Top Referers</p>
                    <table class="table table-striped">
                        <thead>
                            <th>URL</th>
                            <th>Views</th>
                        </thead>
                        @foreach (Analytics::getTopReferrers(365, 10) as $referers)
                            <tr>
                                <td>{{ $referers['url'] }}</td>
                                <td>{{ $referers['pageViews'] }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="col-md-6">
                    <p class="lead">Top Browsers</p>
                    <table class="table table-striped">
                        <thead>
                            <th>Browser</th>
                            <th>Sessions</th>
                        </thead>
                        @foreach (Analytics::getTopBrowsers(365, 10) as $browser)
                            <tr>
                                <td>{{ $browser['browser'] }}</td>
                                <td>{{ $browser['sessions'] }}</td>
                            </tr>
                        @endforeach
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
            _labels : {!! json_encode($visitStats['date']) !!},
            _visits : {!! json_encode($visitStats['pageViews']) !!}
        };

        var options = {};

    </script>
    {!! Minify::javascript('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js') !!}
    {!! Minify::javascript(Quarx::asset('js/dashboard-chart.js')) !!}
@stop
