@extends('quarx-frontend::layout.master')

@section('content')

    <style type="text/css">

        .menu a {
            display: block;
            float: left;
            padding: 24px;
        }


    </style>

    <div class="menu row">
        {!! Quarx::menu('main') !!}
    </div>

    <h1>{!! $page->title !!}</h1>
    {!! $page->entry !!}

@endsection

@section('quarx')
    {!! Quarx::editBtn('pages', $page->id) !!}
@endsection
