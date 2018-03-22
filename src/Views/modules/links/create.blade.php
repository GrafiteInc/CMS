@extends('cms::layouts.dashboard')

@section('pageTitle') Links @stop

@section('content')

    <div class="col-md-12 mt-2">
        @include('cms::modules.links.breadcrumbs', ['location' => [['Menu' => cms()->url('menus/'.request('m').'/edit')], 'links', 'create']])
    </div>

    <div class="col-md-12">
        {!! Form::open(['route' => cms()->route('links.store'), 'class' => 'add']) !!}

            {!! FormMaker::fromTable('links', config('cms.forms.link')) !!}

            <div class="form-group" style="display: none;">
                <label for="Page_id">Page</label>
                <select class="form-control" id="Page_id" name="page_id">
                    @foreach (PageService::getPagesAsOptions() as $key => $value)
                        <option value="{!! $value !!}">{!! $key !!}</option>
                    @endforeach
                </select>
            </div>

            <input type="hidden" name="menu_id" value="{{ request('m') }}">

            <div class="form-group text-right">
                <a href="{!! url()->previous() !!}" class="btn btn-secondary raw-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>
@endsection

@section('javascript')

    @parent
    {!! Minify::javascript(Cms::asset('js/links-module.js', 'application/javascript')) !!}

@stop
