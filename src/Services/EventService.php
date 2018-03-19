<?php

namespace Grafite\Quarx\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use Grafite\Quarx\Repositories\EventRepository;

class EventService
{
    public function __construct(EventRepository $eventRepo)
    {
        $this->eventRepository = $eventRepo;
        $this->weeks = [];
        $this->date = null;
    }

    public function generate($date = null)
    {
        $this->date = $date;

        if (is_null($date)) {
            $this->date = date('Y-m-d');
        }

        $dateAsArray = explode('-', $this->date);

        $today = Carbon::createFromDate($dateAsArray[0], $dateAsArray[1], $dateAsArray[2]);

        foreach (range(1, $today->daysInMonth) as $dayAsNumber) {
            $day = Carbon::createFromDate($today->year, $today->month, $dayAsNumber);

            if ($day->dayOfWeek === 0) {
                $dayOfTheWeek = 7;
            } else {
                $dayOfTheWeek = $day->dayOfWeek;
            }

            $this->weeks[$day->weekOfYear][$dayOfTheWeek] = $day;
        }

        return $this;
    }

    public function calendar($date)
    {
        $events = $this->eventRepository->all();
        $dateArray = explode('-', $date);
        $daysInMonth = Carbon::create($dateArray[0], $dateArray[1], $dateArray[2])->daysInMonth;

        $eventsByDate = [];

        foreach (range(1, $daysInMonth) as $day) {
            $date = $dateArray[0].'-'.$dateArray[1].'-'.sprintf('%02d', $day);
            foreach ($events as $event) {
                $startDate = explode('-', $event->start_date);
                $endDate = explode('-', $event->end_date);
                $first = Carbon::create($startDate[0], $startDate[1], $startDate[2]);
                $second = Carbon::create($endDate[0], $endDate[1], $endDate[2]);
                if (Carbon::create($dateArray[0], $dateArray[1], sprintf('%02d', $day))->between($first, $second)) {
                    $eventsByDate[$date][] = $event;
                }
            }
        }

        return $eventsByDate;
    }

    public function asHtml($config)
    {
        $class = $config['class'];
        $dates = $config['dates'];

        $daysOfTheWeek = [
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday',
            'Sunday',
        ];

        $output = '<table class="'.$class.'">';
        $output .= '<thead>';
        foreach ($daysOfTheWeek as $day) {
            $output .= '<th>'.$day.'</th>';
        }
        $output .= '</thead>';

        foreach ($this->weeks as $week) {
            $output .= '<tr>';
            foreach (range(1, 7) as $dayAsNumber) {
                if (isset($week[$dayAsNumber])) {
                    $content = '';
                    if (isset($dates[$week[$dayAsNumber]->toDateString()])) {
                        $content = $dates[$week[$dayAsNumber]->toDateString()];
                    }

                    if (is_array($content)) {
                        $itemString = '';
                        foreach ($content as $item) {
                            if (config('app.locale') !== config('quarx.default-language')) {
                                if ($item->translationData(config('app.locale'))) {
                                    $itemString .= '<a href="'.URL::to('events/event/'.$item->id).'">'.$item->translationData(config('app.locale'))->title.'</a><br>';
                                }
                            } else {
                                $itemString .= '<a href="'.URL::to('events/event/'.$item->id).'">'.$item->title.'</a><br>';
                            }
                        }
                        $content = $itemString;
                    }

                    $output .= '<td><span class="date"><a href="'.URL::to('events/date/'.$week[$dayAsNumber]->format('Y-m-d')).'">'.$week[$dayAsNumber]->toFormattedDateString().'</a></span><span class="content">'.$content.'</span></td>';
                } else {
                    $output .= '<td>&nbsp;</td>';
                }
            }
            $output .= '</tr>';
        }
        $output .= '</table>';

        return $output;
    }

    public function links($class = null)
    {
        if (is_null($class)) {
            $class = '';
        }

        $dateArray = explode('-', $this->date);
        $previousMonth = Carbon::create($dateArray[0], $dateArray[1], $dateArray[2])->subMonth()->toDateString();
        $nextMonth = Carbon::create($dateArray[0], $dateArray[1], $dateArray[2])->addMonth()->toDateString();

        $links = '';
        $links .= '<a class="previous '.$class.'" href="'.URL::to('events/'.$previousMonth).'">Previous Month</a>';
        $links .= '<a class="next '.$class.'" href="'.URL::to('events/'.$nextMonth).'">Next Month</a>';

        return $links;
    }

    public function getTemplatesAsOptions()
    {
        $availableTemplates = ['show'];
        $templates = glob(base_path('resources/themes/'.Config::get('quarx.frontend-theme').'/events/*'));

        foreach ($templates as $template) {
            $template = str_replace(base_path('resources/themes/'.Config::get('quarx.frontend-theme').'/events/'), '', $template);
            if (stristr($template, 'template')) {
                $template = str_replace('-template.blade.php', '', $template);
                if (!stristr($template, '.php')) {
                    $availableTemplates[] = $template.'-template';
                }
            }
        }

        return $availableTemplates;
    }
}
