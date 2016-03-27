@extends('quarx-frontend::layout.master')

@section('content')

    <div class="jumbotron">
        <h1>Featured Entry</h1>
        <h2>{{ $blog->title }}</h2>
    </div>

    {!! $blog->entry !!}

@endsection

@section('quarx')
    @edit('blogs', $blog->id)
@endsection
