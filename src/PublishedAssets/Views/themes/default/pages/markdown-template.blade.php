@extends('cms-frontend::layout.master')

@section('seoDescription') {{ $page->seo_description }} @endsection
@section('seoKeywords') {{ $page->seo_keywords }} @endsection

@section('content')

<div class="container">

    <h1 class="page-header">{{ $page->title }}</h1>

    @markdown($page->entry)

</div>

@endsection

@section('cms')
    @edit('pages', $page->id)
@endsection
