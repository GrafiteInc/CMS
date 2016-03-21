@extends('quarx-frontend::layout.master')

@section('content')

<div class="container">

    <div class="jumbotron">
        <h1>Featured Entry</h1>
        <h2>{{ $blog->title }}</h2>
    </div>

    {!! $blog->entry !!}

</div>

@endsection

@section('quarx')
    {!! Quarx::editBtn('blogs', $blog->id) !!}
@endsection
