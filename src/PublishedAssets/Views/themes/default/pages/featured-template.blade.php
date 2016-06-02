@extends('quarx-frontend::layout.master')

@section('seoDescription') {{ $page->seo_description }} @endsection
@section('seoKeywords') {{ $page->seo_keywords }} @endsection

@section('content')

<div class="container">

    <div class="jumbotron">
        <h1>Featured Page</h1>
        <h2>{{ $page->title }}</h2>
    </div>

    {!! $page->entry !!}

</div>

@endsection

@section('quarx')
    @edit('pages', $page->id)
@endsection
