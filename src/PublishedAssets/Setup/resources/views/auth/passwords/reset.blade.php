@extends('cms-frontend::layout.master')

@section('content')

    <div class="row">
        <div class="col-md-12 form-small">

            <h1 class="text-center">Password Reset</h1>

            <form method="POST" action="{{ url('/password/reset') }}">
                {!! csrf_field() !!}
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="col-md-12 mt-3">
                    <label>Email</label>
                    <input class="form-control" type="email" name="email" value="{{ old('email') }}">
                </div>
                <div class="col-md-12 mt-3">
                    <label>Password</label>
                    <input class="form-control" type="password" name="password">
                </div>
                <div class="col-md-12 mt-3">
                    <label>Confirm Password</label>
                    <input class="form-control" type="password" name="password_confirmation">
                </div>
                <div class="col-md-12 mt-3">
                    <button class="btn btn-primary" type="submit">Reset Password</button>
                </div>
            </form>
        </div>
    </div>

@stop
