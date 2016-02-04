@extends('quarx::layouts.blank')

@section('content')

    <div class="container raw-margin-bottom-24">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Create A Team</h1>
                <div class="col-md-12 text-center">
                    @include('partials.navigation')
                </div>

                @include('partials.errors')
                @include('partials.message')

                <div class="col-md-4 col-md-offset-4">
                    {!! Form::open(['route' => 'teams.store']) !!}

                    {!! FormMaker::fromTable("teams", ['name' => 'string']) !!}

                    {!! Form::submit('Save', ['class' => 'btn btn-primary pull-right']) !!}

                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>

@stop