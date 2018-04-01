<?php

namespace Grafite\Cms\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Grafite\Cms\Models\Analytics;

class AnalyticsService
{
    public function __construct(Analytics $model)
    {
        $this->model = $model;
    }

    public function log($request)
    {
        $requestData = json_encode([
            'referer' => $request->server('HTTP_REFERER', null),
            'user_agent' => $request->server('HTTP_USER_AGENT', null),
            'host' => $request->server('HTTP_HOST', null),
            'remote_addr' => $request->server('REMOTE_ADDR', null),
            'uri' => $request->server('REQUEST_URI', null),
            'method' => $request->server('REQUEST_METHOD', null),
            'query' => $request->server('QUERY_STRING', null),
            'time' => $request->server('REQUEST_TIME', null),
        ]);

        if (Schema::hasTable(config('cms.db-prefix', '').'analytics')) {
            $this->model->create([
                'data' => $requestData,
            ]);
        }
    }

    public function topReferers($count)
    {
        $analytics = $this->model->where('created_at', '>', Carbon::now()->subDays($count))->get();
        $data = $analytics->pluck('data')->all();

        return $this->convertDataToItems($data, 'referer', ['unknown' => 0]);
    }

    public function topPages($count)
    {
        $analytics = $this->model->where('created_at', '>', Carbon::now()->subDays($count))->get();
        $data = $analytics->pluck('data')->all();

        return $this->convertDataToItems($data, 'uri');
    }

    public function topBrowsers($count)
    {
        $analytics = $this->model->where('created_at', '>', Carbon::now()->subDays($count))->get();
        $data = $analytics->pluck('data')->all();

        $browsers = [];

        foreach ($this->convertDataToItems($data, 'user_agent') as $userAgent => $count) {
            $browser = parse_user_agent($userAgent);
            $browsers[$browser['browser'].' ('.$browser['version'].') on '.$browser['platform']] = $count;
        }

        return $browsers;
    }

    public function convertDataToItems($data, $key, $conversions = [], $limit = 15)
    {
        if (!isset($conversions['unknown'])) {
            $conversions['unknown'] = 0;
        }

        if (!isset($conversions['unknown'])) {
            $conversions['unknown'] = 0;
        }

        foreach ($data as $item) {
            $visit = json_decode($item);
            if (!empty($visit->$key) && $visit->$key > '') {
                $conversions[$visit->$key] = 0;
            }
        }

        foreach ($data as $item) {
            $visit = json_decode($item);
            if (!empty($visit->$key) && $visit->$key > '') {
                $conversions[$visit->$key] += 1;
            } else {
                $conversions['unknown'] += 1;
            }
        }

        return array_slice($conversions, 0, $limit);
    }

    public function getDays($count)
    {
        $analytics = $this->model->where('created_at', '>', Carbon::now()->subDays($count));

        if ($analytics->first()) {
            $endDate = Carbon::now();
            $startDate = Carbon::parse($analytics->first()->created_at->format('Y-m-d'));

            $dateRange = $this->getDateRange($startDate, $endDate);

            foreach ($dateRange as $date) {
                $visits[$date] = $this->model->where('created_at', '>', $date.' 00:00:00')->where('created_at', '<', $date.' 23:59:59')->count();
            }

            $visitCollection = collect($visits);
        } else {
            $visitCollection = collect([
                Carbon::now()->format('Y-m-d') => 0,
            ]);
        }

        return [
            'dates' => $visitCollection->keys()->toArray(),
            'visits' => $visitCollection->values()->toArray(),
        ];
    }

    protected function getDateRange($startDate, $endDate)
    {
        $dates = [];

        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            $dates[] = $date->format('Y-m-d');
        }

        return $dates;
    }
}
