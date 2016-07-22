@extends('quarx-frontend::layout.master')

@section('seoDescription') {{ $blog->seo_description }} @endsection
@section('seoKeywords') {{ $blog->seo_keywords }} @endsection

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
    @edit('blog', $blog->id)
@endsection
