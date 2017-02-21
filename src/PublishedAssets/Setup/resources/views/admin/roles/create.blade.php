@extends('quarx::layouts.dashboard')

@section('content')

    <div class="row">
        <h1 class="page-header">Roles: Create</h1>
    </div>
    <div class="row">
        <form method="POST" action="/admin/roles">
            {!! csrf_field() !!}

            <div class="col-md-12 form-group">
                @input_maker_label('Name')
                @input_maker_create('name', ['type' => 'string'])
            </div>

            <div class="col-md-12 form-group">
                @input_maker_label('Label')
                @input_maker_create('label', ['type' => 'string'])
            </div>

            <div class="form-group">
                <h3>Permissions</h3>
                @foreach(Config::get('permissions', []) as $permission => $name)
                    <div class="checkbox">
                        <label for="{{ $name }}">
                            <input type="checkbox" name="permissions[{{ $permission }}]" id="{{ $name }}">
                            {{ $name }}
                        </label>
                    </div>
                @endforeach
            </div>

            <div class="col-md-12 form-group">
                <a class="btn btn-default pull-left" href="{{ URL::previous() }}">Cancel</a>
                <button class="btn btn-primary pull-right" type="submit">Create</button>
            </div>
        </form>
    </div>

@stop