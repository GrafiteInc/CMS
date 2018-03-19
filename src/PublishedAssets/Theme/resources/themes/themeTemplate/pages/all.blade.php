@extends('cms-frontend::layout.master')

@section('content')

<div class="container">

    <h1 class="page-header">Pages Directory</h1>

    <table class="table table-striped">
        @foreach($pages as $page)
            <tr>
                <td><a href="{!! url('page/'.$page->url) !!}">{{ $page->title }}</a></td>
            </tr>
        @endforeach
    </table>

</div>

@endsection

@section('cms')
    @edit('pages')
@endsection