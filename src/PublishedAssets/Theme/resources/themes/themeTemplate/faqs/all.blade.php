@extends('quarx-frontend::layout.master')

@section('content')
    <h1>FAQs</h1>

    @foreach($faqs as $faq)
        <div class="container-fluid">
            <blockquote>{!! $faq->question !!}</blockquote>
            <div class="well">
                {!! $faq->answer !!}
            </div>
            @edit('faqs', $faq->id)
        </div>
    @endforeach

@endsection

@section('quarx')
    @edit('faqs')
@endsection