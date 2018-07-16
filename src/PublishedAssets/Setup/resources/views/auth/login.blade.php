@extends('cms-frontend::layout.master')

@section('content')

    <div class="form-small">

        <h2 class="text-center">Please sign in</h2>

        <form method="POST" action="{{ url('/login') }}">
            {!! csrf_field() !!}
            <div class="col-md-12 mt-3">
                <label>Email</label>
                <input class="form-control" type="email" name="email" placeholder="Email" value="{{ old('email') }}">
            </div>
            <div class="col-md-12 mt-3">
                <label>Password</label>
                <input class="form-control" type="password" name="password" placeholder="Password" id="password">
            </div>
            <div class="col-md-12 mt-3">
                <label>
                    Remember Me <input type="checkbox" name="remember">
                </label>
            </div>
            <div class="col-md-12 mt-3">
                <div class="btn-toolbar justify-content-between">
                    <button class="btn btn-primary" type="submit">Login</button>
                    <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Password</a>
                </div>
            </div>

            @if (config('cms.registration-available'))
                <div class="col-md-12 mt-3">
                    <a class="btn raw100 btn-info btn-block" href="{{ url('/register') }}">Register</a>
                </div>
            @endif
        </form>

    </div>

@stop

