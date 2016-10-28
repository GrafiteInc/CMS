@extends('quarx-frontend::layout.master')

@section('content')

<div class="container">

    <h1>Pages</h1>

    @foreach($pages as $page)
        <a href="{!! url('page/'.$page->url) !!}">{{ $page->title }}</a><br>
    @endforeach

</div>

@endsection

@section('quarx')
    @edit('pages')
@endsection