<?php

namespace Yab\Cabin\Controllers;

use Illuminate\Support\Facades\Schema;
use Spatie\LaravelAnalytics\LaravelAnalyticsFacade as LaravelAnalytics;
use Yab\Cabin\Services\AnalyticsService;

class DashboardController extends CabinController
{
    protected $service;

    public function __construct(AnalyticsService $service)
    {
        parent::construct();

        $this->service = $service;
    }

    public function main()
    {
        if (!is_null(config('laravel-analytics.siteId')) && config('cabin.analytics') == 'google') {
            foreach (LaravelAnalytics::getVisitorsAndPageViews(7) as $view) {
                $visitStats['date'][] = $view['date']->format('Y-m-d');
                $visitStats['visitors'][] = $view['visitors'];
                $visitStats['pageViews'][] = $view['pageViews'];
            }

            return view('cabin::dashboard.analytics-google', compact('visitStats', 'oneYear'));
        } elseif (is_null(config('cabin.analytics')) || config('cabin.analytics') == 'internal') {
            if (Schema::hasTable(config('cabin.db-prefix', '').'analytics')) {
                return view('cabin::dashboard.analytics-internal')
                    ->with('stats', $this->service->getDays(15))
                    ->with('topReferers', $this->service->topReferers(15))
                    ->with('topBrowsers', $this->service->topBrowsers(15))
                    ->with('topPages', $this->service->topPages(15));
            }
        }

        return view('cabin::dashboard.empty');
    }
}
