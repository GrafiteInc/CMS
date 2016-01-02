@extends('quarx::layouts.dashboard')

@section('content')

    <div class="row">
        <h1 class="page-header">FAQS</h1>
    </div>

    @include('quarx::modules.faqs.breadcrumbs', ['location' => ['create']])

    {!! Form::open(['route' => 'quarx.faqs.store']) !!}

        {!! FormMaker::fromTable('faqs', Quarx::config('forms.faqs')) !!}

        <div class="form-group text-right">
            <a href="{!! URL::previous() !!}" class="btn btn-default raw-left">Cancel</a>
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        </div>

    {!! Form::close() !!}

@endsection
