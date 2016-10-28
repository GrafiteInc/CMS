@extends('quarx-frontend::layout.master')

@section('content')

<div class="container">

    <h1>Blog</h1>

    <div class="row">
        <div class="col-md-8">
            @foreach($blogs as $blog)
                @if (config('app.locale') !== config('quarx.default-language'))
                    @if ($blog->translation(config('app.locale')))
                        <a href="{!! URL::to('blog/'.$blog->translation(config('app.locale'))->data->url) !!}"><p>{!! $blog->translation(config('app.locale'))->data->title !!} - <span>{!! $blog->published_at !!}</span></p></a>
                    @endif
                @else
                    <a href="{!! URL::to('blog/'.$blog->url) !!}"><p>{!! $blog->title !!} - <span>{!! $blog->published_at !!}</span></p></a>
                @endif
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