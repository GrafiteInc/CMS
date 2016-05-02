@extends('quarx-frontend::layout.master')

@section('content')

<div class="container">

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

</div>

@endsection

@section('quarx')
    @edit('faqs')
@endsection