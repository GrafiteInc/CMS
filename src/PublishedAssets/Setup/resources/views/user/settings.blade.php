@extends('cms-frontend::layout.master')

@section('pageTitle') Settings @stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{ url('/user/settings') }}">
                    {!! csrf_field() !!}

                    <div>
                        @input_maker_label('Email')
                        @input_maker_create('email', ['type' => 'string'], $user)
                    </div>

                    <div class="mt-3">
                        @input_maker_label('Name')
                        @input_maker_create('name', ['type' => 'string'], $user)
                    </div>

                    @include('user.meta')

                    @if ($user->roles->first()->name === 'admin' || $user->id == 1)
                        <div class="mt-3">
                            @input_maker_label('Role')
                            @input_maker_create('roles', ['type' => 'relationship', 'model' => 'App\Models\Role', 'label' => 'label', 'value' => 'name'], $user)
                        </div>
                    @endif

                    <div class="mt-3">
                        <div class="btn-toolbar justify-content-between">
                            <button class="btn btn-primary" type="submit">Save</button>
                            <a class="btn btn-link" href="/user/password">Change Password</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop
