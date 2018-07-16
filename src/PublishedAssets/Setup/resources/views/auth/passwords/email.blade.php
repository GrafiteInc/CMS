@extends('cms-frontend::layout.master')

@section('content')

    <div class="form-small">

        <h2 class="text-center">Forgot Password</h2>

        <form method="POST" action="{{ url('/password/email') }}">
            {!! csrf_field() !!}
            @include('partials.errors')
            @include('partials.status')

            <div class="col-md-12 mt-3">
                <label>Email</label>
                <input class="form-control" type="email" name="email" placeholder="Email" value="{{ old('email') }}">
            </div>
            <div class="col-md-12 mt-3">
                <button class="btn btn-primary btn-block" type="submit" class="button">Send Password Reset Link</button>
            </div>
            <div class="col-md-12 mt-3">
                <a class="btn btn-link" href="{{ url('/login') }}">Wait I remember!</a>
            </div>
        </form>

    </div>

@stop
