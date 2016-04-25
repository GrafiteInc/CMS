@extends('quarx::layouts.blank')

@section('content')

<div class="container">
    <div class="row">
        <h1 class="text-center">Account Settings</h1>
        <div class="col-md-12 text-center">
            @include('partials.navigation')
        </div>

        <div class="col-md-12">

            @include('partials.errors')
            @include('partials.message')

            <form method="POST" action="/admin/users/{{ $user->id }}">
                <input name="_method" type="hidden" value="PATCH">
                {!! csrf_field() !!}

                <div class="col-md-12 raw-margin-top-24">
                    <label>Email</label>
                    <input class="form-control" type="email" name="email" value="{{ $user->email }}">
                </div>

                <div class="col-md-12 raw-margin-top-24">
                   <label> Name</label>
                    <input class="form-control" type="name" name="name" value="{{ $user->name }}">
                </div>

                @include('user.meta')

                <div class="col-md-12 raw-margin-top-24">
                   <label> Role</label>
                    @input_maker_create('roles', ['type' => 'relationship', 'model' => 'App\Repositories\Role\Role', 'label' => 'label', 'value' => 'name'], $user)
                </div>

                <div class="col-md-12 raw-margin-top-24">
                    <a class="btn btn-default pull-left" href="{{ URL::previous() }}">Cancel</a>
                    <button class="btn btn-primary pull-right" type="submit">Save</button>
                </div>
            </form>

        </div>
    </div>

@stop