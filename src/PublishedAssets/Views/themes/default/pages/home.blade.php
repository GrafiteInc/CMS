@extends('quarx-frontend::layout.master')

@if (isset($page))
    @section('seoDescription') {{ $page->seo_description }} @endsection
    @section('seoKeywords') {{ $page->seo_keywords }} @endsection
@endif

@section('content')

<div class="container">

    <div class="jumbotron">
        <h1>{!! $page->title or 'Home Page' !!}</h1>
    </div>

    @if (isset($page))
        {!! $page->entry !!}
    @else
        <div class="row">
            <div class="col-md-4">
                <div class="well">
                    <h3>Basics</h3>
                    <p>In order to add content to this page login to Quarx and add a home page. Remember you can set up
                        your own Auth for Quarx or run the artisan command: <code>php artisan quarx:setup</code> to get
                        a prebuilt auth system.</p>
                    <p>Once you're all set up try building a menu with slug: main, and a widget with the slug: widget. You'll see the theme display them right away!</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="well">
                    <h3>Custom Templates</h3>
                    <p>By default the homepage has its own template but you can add any by following these details:</p>
                    <p>To create custom templates for different purposes simply make a view in <br>
                        the <code>resources/themes/{theme-name}/{module-name}</code> directory that looks similar to: `xxxx-template.blade.php`. <br>
                        This means you still have full control of blade templating but your pages can easily swap out views.</p>
                    <h3>Custom Themes</h3>
                    <p>You can easily generate a theme template via the command: <code>php artisan theme:generate {name}</code> </p>
                    <p>The theme's files will be placed in the following directory: <code>resources/themes/{name}</code></p>
                    <p>To include files either use the blade code: <code>&#64;theme</code> or include a file with the <code>quarx-frontend::</code> namespace.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="well">
                    <h3>Widgets, Menus, Images &amp; Includes</h3>
                    <p>Widgets are easy to add to any template since they can be injected with the <code>&#64;menu('slug')</code>, <code>&#64;widget('slug')</code> or <code>&#64;images('tag')</code>. If you don't suppy a tag for the images you will get all images. To include a theme view you can easily use: <code>&#64;theme('path.in.theme')</code>.</p>
                </div>
                <br>
            </div>
        </div>
    @endif

</div>
@endsection

@section('quarx')
    @if (isset($page))
        @edit('pages', $page->id)
    @endif
@endsection
