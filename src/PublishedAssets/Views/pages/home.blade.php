@extends('quarx-frontend::layout.master')

@section('content')

    <h1>{!! $page->title !!}</h1>
    {!! $page->entry !!}

@endsection

@section('quarx')
    {!! Quarx::editBtn('pages', $page->id) !!}
@endsection