@extends('quarx-frontend::layout.master')

@section('content')

    <h1>Pages</h1>

    @foreach($pages as $page)
        <a href="{!! url('page/'.$page->url) !!}">{{ $page->title }}</a><br>
    @endforeach

@endsection

@section('quarx')
    @edit('pages')
@endsection