@extends('quarx-frontend::layout.master')

@section('content')

<div class="container">

    <h1>Blog</h1>

    <div class="row">
        <div class="col-md-8">
            @foreach($blogs as $blog)
                <a href="{!! URL::to('blog/'.$blog->url) !!}"><p>{!! $blog->title !!} - <span>{!! $blog->updated_at !!}</span></p></a>
            @endforeach

            {!! $blogs !!}
        </div>

        <div class="col-md-4">
            @foreach($tags as $tag)
                <a href="{{ url('blog/tags/'.$tag) }}" class="btn btn-default">{{ $tag }}</a>
            @endforeach
        </div>
    </div>

</div>

@endsection

@section('quarx')
    @edit('blog')
@endsection