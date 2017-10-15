<?php

namespace Yab\Quarx\Controllers;

use Illuminate\Support\Facades\Schema;
use Spatie\LaravelAnalytics\LaravelAnalyticsFacade as LaravelAnalytics;
use Yab\Quarx\Services\AnalyticsService;

class DashboardController extends QuarxController
{
    public function __construct(AnalyticsService $service)
    {
        parent::construct();

        $this->service = $service;
    }

    public function main()
    {
        if (!is_null(config('laravel-analytics.siteId')) && config('quarx.analytics') == 'google') {
            foreach (LaravelAnalytics::getVisitorsAndPageViews(7) as $view) {
                $visitStats['date'][] = $view['date']->format('Y-m-d');
                $visitStats['visitors'][] = $view['visitors'];
                $visitStats['pageViews'][] = $view['pageViews'];
            }

            return view('quarx::dashboard.analytics-google', compact('visitStats', 'oneYear'));
        } elseif (is_null(config('quarx.analytics')) || config('quarx.analytics') == 'internal') {
            if (Schema::hasTable(config('quarx.db-prefix', '').'analytics')) {
                return view('quarx::dashboard.analytics-internal')
                    ->with('stats', $this->service->getDays(15))
                    ->with('topReferers', $this->service->topReferers(15))
                    ->with('topBrowsers', $this->service->topBrowsers(15))
                    ->with('topPages', $this->service->topPages(15));
            }
        }

        return view('quarx::dashboard.empty');
    }
}
