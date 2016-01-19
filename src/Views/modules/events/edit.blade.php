@extends('quarx::layouts.dashboard')

@section('content')

        <div class="row">
            <h1 class="page-header">Events</h1>
        </div>

        @include('quarx::modules.events.breadcrumbs', ['location' => ['edit']])

        {!! Form::model($event, ['route' => ['quarx.events.update', CryptoService::encrypt($event->id)], 'method' => 'patch']) !!}

            {!! FormMaker::fromObject($event, Config::get('quarx.forms.event')) !!}

            <div class="form-group text-right">
                <a href="{!! URL::previous() !!}" class="btn btn-default raw-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>
@endsection
