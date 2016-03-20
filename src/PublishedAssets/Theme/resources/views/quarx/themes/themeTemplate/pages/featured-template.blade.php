@extends('quarx-frontend::layout.master')

@section('content')

    <div class="jumbotron">
        <h1>Featured Page</h1>
        <h2>{{ $page->title }}</h2>
    </div>

    {!! $page->entry !!}

@endsection

@section('quarx')
    {!! Quarx::editBtn('pages', $page->id) !!}
@endsection
