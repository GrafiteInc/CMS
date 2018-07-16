@extends('cms-frontend::layout.master')

@section('content')

    <div class="form-small">
        <h2 class="text-center">Register</h2>

        <form method="POST" action="{{ url('/register') }}">
            {!! csrf_field() !!}

            <div class="col-md-12 mt-3">
                <label>Name</label>
                <input class="form-control" type="text" name="name" value="{{ old('name') }}" placeholder="Name">
            </div>
            <div class="col-md-12 mt-3">
                <label>Email</label>
                <input class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="Email">
            </div>
            <div class="col-md-12 mt-3">
                <label>Password</label>
                <input class="form-control" type="password" name="password" placeholder="Password">
            </div>
            <div class="col-md-12 mt-3">
                <label>Confirm Password</label>
                <input class="form-control" type="password" name="password_confirmation" placeholder="Password Confirmation">
            </div>
            <div class="col-md-12 mt-3">
                <div class="btn-toolbar justify-content-between">
                    <button class="btn btn-primary" type="submit">Register</button>
                    <a class="btn btn-link" href="{{ url('/login') }}">Login</a>
                </div>
            </div>
        </form>
    </div>

@stop
