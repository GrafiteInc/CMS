<?php

namespace Yab\Quarx\Controllers;

use Analytics;

class DashboardController extends QuarxController
{
    public function main()
    {
        if (is_null(env('ANALYTICS_VIEW_ID'))) {
            return view('quarx::dashboard.empty');
        }

        foreach (Analytics::getVisitorsAndPageViews(7) as $view) {
            $visitStats['date'][] = $view['date']->format('Y-m-d');
            $visitStats['visitors'][] = $view['visitors'];
            $visitStats['pageViews'][] = $view['pageViews'];
        }

        return view('quarx::dashboard.analytics', ['visitStats' => $visitStats]);
    }
}
