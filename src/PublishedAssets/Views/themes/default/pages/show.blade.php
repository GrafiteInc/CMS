@extends('quarx-frontend::layout.master')

@section('content')

<div class="container">

    <h1>{!! $page->title !!}</h1>
    {!! $page->entry !!}

</div>

@endsection

@section('quarx')
    @edit('pages', $page->id)
@endsection
