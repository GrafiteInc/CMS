@extends('quarx-frontend::layout.master')

<style type="text/css">

.calendar {
    width: 100%;
    min-height: 100%;
}

    .calendar th {
        background-color: #DDD;
        padding: 8px;
    }

    .calendar td {
        vertical-align: top;
        padding: 8px;
        text-align: left;
        border: 1px solid #EEE;
        height: 160px;
        width: calc(100% / 7);
    }

    .calendar td .today {
        background-color: #DDD;
    }

    .calendar td .date {
        float: right;
        text-align: right;
        width: 100%;
    }
    .calendar td .content {
        float: right;
        width: 100%;
    }

.cal-link {
    margin-top: 24px;
}

.previous {
    float: left;
}

.next {
    float: right;
}

</style>

@section('content')

    <h1>Calendar</h1>

    <div class="row">
        <div class="col-md-12">
            {!! $calendar->asHtml([ 'class' => 'calendar', 'dates' => $events ]); !!}
            {!! $calendar->links('cal-link btn btn-default'); !!}
        </div>
    </div>

@endsection

@section('quarx')
    {!! Quarx::editBtn('events') !!}
@endsection