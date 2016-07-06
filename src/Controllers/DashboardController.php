<?php

namespace Yab\Quarx\Controllers;

use Analytics;
use Spatie\Analytics\Period;

class DashboardController extends QuarxController
{
    public function main()
    {
        if (is_null(env('ANALYTICS_VIEW_ID'))) {
            return view('quarx::dashboard.empty');
        }

        foreach (Analytics::fetchVisitorsAndPageViews(Period::days(7)) as $view) {
            $visitStats['date'][] = $view['date']->format('Y-m-d');
            $visitStats['visitors'][] = $view['visitors'];
            $visitStats['pageViews'][] = $view['pageViews'];
        }

        $oneYear = Period::days(365);

        return view('quarx::dashboard.analytics', compact('visitStats', 'oneYear'));
    }
}
