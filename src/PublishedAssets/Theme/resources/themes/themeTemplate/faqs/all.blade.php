@extends('cms-frontend::layout.master')

@section('content')

<div class="container">

    <h1 class="page-header">FAQs</h1>

    <div class="entry-row">
        @widget('faq-description')
    </div>

    @foreach($faqs as $faq)
        @if (config('app.locale') !== config('cms.default-language'))
            <blockquote>{!! $faq->translationData(config('app.locale'))->question !!}</blockquote>
            <div class="well">
                {!! $faq->translationData(config('app.locale'))->answer !!}
            </div>
            @editBtn('faqs', $faq->id)
        @else
            <blockquote>{!! $faq->question !!}</blockquote>
            <div class="well">
                {!! $faq->answer !!}
            </div>
            @editBtn('faqs', $faq->id)
        @endif
    @endforeach

</div>

@endsection

@section('cms')
    <li class="nav-text">@edit('faqs')</li>
@endsection