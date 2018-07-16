@extends('cms::layouts.dashboard')

@section('pageTitle') Users: Invite @stop

@section('content')

    <form class="form" method="POST" action="{{ url('/admin/users/invite') }}">
        {!! csrf_field() !!}

        <div class="col-md-12">
            <div class="form-group">
                @input_maker_label('Email')
                @input_maker_create('email', ['type' => 'string'])
            </div>
        </div>

        <div class="col-md-12">
            @input_maker_label('Name')
            @input_maker_create('name', ['type' => 'string'])
        </div>

        <div class="col-md-12 mt-4">
            @input_maker_label('Role')
            @input_maker_create('roles', ['type' => 'relationship', 'model' => 'App\Models\Role', 'label' => 'label', 'value' => 'name'])
        </div>

        <div class="col-md-12 mt-4">
            <a class="btn btn-secondary float-left" href="{{ url()->previous() }}">Cancel</a>
            <button class="btn btn-primary float-right" type="submit">Invite</button>
        </div>
    </form>

@stop
