@extends('quarx-frontend::layout.master')

@section('content')
    <h1>FAQs</h1>

    @foreach($faqs as $faq)
        <div class="container-fluid">
            <blockquote>{!! $faq->question !!}</blockquote>
            <div class="well">
                {!! $faq->answer !!}
            </div>
        </div>
    @endforeach

@endsection