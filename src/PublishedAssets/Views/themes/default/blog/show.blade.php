@extends('quarx-frontend::layout.master')

@section('content')

<div class="container">

    <h1>{!! $blog->title !!} - <span>{!! $blog->updated_at !!}</span></h1>
    {!! $blog->entry !!}

</div>

@endsection

@section('quarx')
    @edit('blog', $blog->id)
@endsection
