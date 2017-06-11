@extends('quarx::layouts.dashboard')

@section('content')

    <div class="row">
        <h1 class="page-header">Menus</h1>
    </div>

    @include('quarx::modules.menus.breadcrumbs', ['location' => ['edit']])

    <div class="row">
        {!! Form::model($menu, ['route' => [config('quarx.backend-route-prefix', 'quarx').'.menus.update', $menu->id], 'method' => 'patch', 'class' => 'edit']) !!}

            {!! FormMaker::fromObject($menu, Config::get('quarx.forms.menu')) !!}

            <div class="form-group text-right">
                <a href="{!! url(config('quarx.backend-route-prefix', 'quarx').'/menus') !!}" class="btn btn-default raw-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

    <div class="row raw-margin-top-24">
        <div class="col-12">
            <a class="btn btn-info pull-right" href="{!! url(config('quarx.backend-route-prefix', 'quarx').'/links/create?m='.$menu->id) !!}">Add Link</a>
            <h1>Links <span class="small fa fa-info-circle" data-toggle="tooltip" title="Drag and drop to sort"></span></h1>
            @include('quarx::modules.links.index')
        </div>
    </div>

@endsection

@section('pre_javascript')

    @parent
    var _linkOrder = @if (!is_null($menu->order)) {!! $menu->order !!} @else [] @endif;
    var _id = {{ $menu->id }};
    var _quarxUrl = _url + "/{{ config('quarx.backend-route-prefix') }}"

@stop
