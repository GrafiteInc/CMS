@extends('quarx-frontend::layout.master')

@section('content')

<div class="container">

    <h1>FAQs</h1>

    @widget('sample')

    @foreach($faqs as $faq)
        <div class="container-fluid">
        @if (config('app.locale') !== config('quarx.default-language'))
            <blockquote>{!! $faq->translationData(config('app.locale'))->question !!}</blockquote>
            <div class="well">
                {!! $faq->translationData(config('app.locale'))->answer !!}
            </div>
            @edit('faqs', $faq->id)
        @else
            <blockquote>{!! $faq->question !!}</blockquote>
            <div class="well">
                {!! $faq->answer !!}
            </div>
            @edit('faqs', $faq->id)
        @endif
        </div>
    @endforeach

</div>

@endsection

@section('quarx')
    @edit('faqs')
@endsection