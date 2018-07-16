@extends('cms::layouts.dashboard')

@section('pageTitle') Roles: Create @stop

@section('content')

    <div class="col-md-12">
        <form method="POST" action="{{ url('/admin/roles') }}">
            {!! csrf_field() !!}

            <div class="form-group">
                @input_maker_label('Name')
                @input_maker_create('name', ['type' => 'string'])
            </div>

            <div class="form-group">
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

            <div class="form-group">
                <a class="btn btn-secondary float-left" href="{{ url()->previous() }}">Cancel</a>
                <button class="btn btn-primary float-right" type="submit">Create</button>
            </div>
        </form>
    </div>

@stop
