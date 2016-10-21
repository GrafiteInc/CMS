@extends('quarx::layouts.dashboard')

@section('content')

    <div class="row">
        <h1 class="page-header">Users: Invite</h1>
    </div>
    <div class="row">
        <form method="POST" action="/admin/users/invite">
            {!! csrf_field() !!}

            <div class="col-md-12 raw-margin-top-24">
                @input_maker_label('Email')
                @input_maker_create('email', ['type' => 'string'])
            </div>

            <div class="col-md-12 raw-margin-top-24">
                @input_maker_label('Name')
                @input_maker_create('name', ['type' => 'string'])
            </div>

            <div class="col-md-12 raw-margin-top-24">
                @input_maker_label('Role')
                @input_maker_create('roles', ['type' => 'relationship', 'model' => 'App\Models\Role', 'label' => 'label', 'value' => 'name'])
            </div>

            <div class="col-md-12 raw-margin-top-24">
                <a class="btn btn-default pull-left" href="{{ URL::previous() }}">Cancel</a>
                <button class="btn btn-primary pull-right" type="submit">Invite</button>
            </div>
        </form>
    </div>

@stop