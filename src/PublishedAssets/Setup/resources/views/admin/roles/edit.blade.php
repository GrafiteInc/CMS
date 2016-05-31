@extends('quarx::layouts.dashboard')

@section('content')

    <div class="row">
        <h1 class="page-header">Roles: Edit</h1>
    </div>
    <div class="row">
        <form method="POST" action="/admin/roles/{{ $role->id }}">
            <input name="_method" type="hidden" value="PATCH">
            {!! csrf_field() !!}

            <div class="col-md-12 raw-margin-top-24">
                @input_maker_label('Name')
                @input_maker_create('name', ['type' => 'string'], $role)
            </div>

            <div class="col-md-12 raw-margin-top-24">
                @input_maker_label('Label')
                @input_maker_create('label', ['type' => 'string'], $role)
            </div>

            <div class="col-md-12 raw-margin-top-24">
                <a class="btn btn-default pull-left" href="{{ URL::previous() }}">Cancel</a>
                <button class="btn btn-primary pull-right" type="submit">Save</button>
            </div>
        </form>
    </div>

@stop