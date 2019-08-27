@extends('cms::layouts.dashboard')

@section('pageTitle') Blog @stop

@section('content')

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6 mt-2">
                @include('cms::modules.blogs.breadcrumbs', ['location' => ['edit']])
            </div>
            <div class="col-md-6">
                <div class="btn-toolbar float-right mt-2 mb-4">
                    @if (! cms()->isDefaultLanguage())
                        @if (isset($blog->translation(request('lang'))->is_published))
                            <a class="btn btn-success ml-1" href="{!! url('blog/'.$blog->id) !!}">Live</a>
                        @else
                            <a class="btn btn-success ml-1" href="{!! cms()->url('preview/blog/'.$blog->id.'?lang='.request('lang')) !!}">Preview</a>
                        @endif
                        <a class="btn btn-warning ml-1" href="{!! Cms::rollbackUrl($blog->translation(request('lang'))) !!}">Rollback</a>
                    @else
                        @if ($blog->is_published)
                            <a class="btn btn-success ml-1" href="{!! url('blog/'.$blog->url) !!}">Live</a>
                        @else
                            <a class="btn btn-outline-success ml-1" href="{!! cms()->url('preview/blog/'.$blog->id) !!}">Preview</a>
                        @endif
                        <a class="btn btn-warning ml-1" href="{!! Cms::rollbackUrl($blog) !!}">Rollback</a>
                        <a class="btn btn-outline-secondary ml-1" href="{!! cms()->url('blog/'.$blog->id.'/history') !!}">History</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="row mb-4">
            <div class="col-md-12">
                <ul class="nav nav-tabs">
                    @include('cms::layouts.tabs', [ 'module' => 'blog', 'item' => $blog ])
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10">
                {!! $form !!}
            </div>
            <div class="col-md-2">
                @if ($blog->hero_image)
                    <img class="img-thumbnail img-fluid mt-4" src="{{ $blog->hero_image_url }}" alt="">
                    <div class="btn-toolbar mt-2" role="toolbar">
                        <a href="{{ cms()->url('hero-images/delete/blog/'.$blog->id) }}" class="btn btn-block btn-outline-danger">
                            <span class="fa fa-fw fa-trash"></span> Delete
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
