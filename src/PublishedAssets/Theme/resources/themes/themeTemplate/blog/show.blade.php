@extends('quarx-frontend::layout.master')

@section('seoDescription') {{ $blog->seo_description }} @endsection
@section('seoKeywords') {{ $blog->seo_keywords }} @endsection

@section('content')

    <h1>{!! $blog->title !!} - <span>{!! $blog->updated_at !!}</span></h1>
    {!! $blog->entry !!}

@endsection

@section('quarx')
    @edit('blog', $blog->id)
@endsection
