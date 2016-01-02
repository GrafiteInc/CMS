@extends('quarx-frontend::layout.master')

@section('content')

    <h1>{!! $blog->title !!} - <span>{!! $blog->updated_at !!}</span></h1>
    {!! $blog->entry !!}

@endsection
