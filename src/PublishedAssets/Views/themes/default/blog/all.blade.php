@extends('cms-frontend::layout.master')

@section('seoDescription') A delightful collection of posts by me over the years. Feel free to browse through the past and present while I build software for the future. @endsection
@section('seoKeywords') @endsection

@section('content')

<div class="container">

    <h1 class="page-header">Blog</h1>

    <div class="row">
        <div class="col-md-8">
            @foreach($blogs as $blog)
                <div class="card entry-row">
                    <div class="card-header">
                        @if (config('app.locale') !== config('cms.default-language'))
                            @if ($blog->translation(config('app.locale')))
                                <a href="{!! URL::to('blog/'.$blog->translation(config('app.locale'))->data->url) !!}">{!! $blog->translation(config('app.locale'))->data->title !!} - <span>{!! $blog->published_at !!}</span></a>
                            @endif
                        @else
                            <a href="{!! URL::to('blog/'.$blog->url) !!}">{!! $blog->title !!} - <span>{!! \Carbon\Carbon::parse($blog->published_at)->format('d M, Y') !!}</span></a>
                        @endif
                    </div>
                    <div class="card-body">
                    {!! str_limit($blog->entry->plain(), 300) !!}
                    </div>
                </div>
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

@section('cms')
    <li class="nav-text">@edit('blog')</li>
@endsection