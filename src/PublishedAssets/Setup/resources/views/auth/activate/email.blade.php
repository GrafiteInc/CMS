@extends('cms-frontend::layout.master')

@section('content')

    <div class="row">
        <div class="col-md-12 form-small text-center">

            <h1 class="text-center">Activate</h1>

            <p>Please check your email to activate your account.</p>

            <a class="btn btn-primary" href="{{ url('activate/send-token') }}">Request new Token</a>

        </div>
    </div>

@stop

