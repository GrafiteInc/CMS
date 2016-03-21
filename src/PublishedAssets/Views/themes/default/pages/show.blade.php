@extends('quarx-frontend::layout.master')

@section('content')

<div class="container">

    <h1>{!! $page->title !!}</h1>
    {!! $page->entry !!}

</div>

@endsection

@section('quarx')
    {!! Quarx::editBtn('pages', $page->id) !!}
@endsection
