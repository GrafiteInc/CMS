<?php

namespace Yab\Quarx\Controllers;

use Spatie\LaravelAnalytics\LaravelAnalyticsFacade as LaravelAnalytics;

class DashboardController extends QuarxController
{
    public function main()
    {
        if (is_null(env('ANALYTICS_SITE_ID'))) {
            return view('quarx::dashboard.empty');
        }

        foreach (LaravelAnalytics::getVisitorsAndPageViews(7) as $view) {
            $visitStats['date'][] = $view['date']->format('Y-m-d');
            $visitStats['visitors'][] = $view['visitors'];
            $visitStats['pageViews'][] = $view['pageViews'];
        }

        return view('quarx::dashboard.analytics', compact('visitStats', 'oneYear'));
    }
}
