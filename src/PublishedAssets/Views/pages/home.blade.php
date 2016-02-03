@extends('quarx-frontend::layout.master')

@section('content')

    @if (isset($page))
        <h1>{!! $page->title !!}</h1>
        {!! $page->entry !!}
    @else
        <h1>Home Page</h1>
        <p>In order to add content to this page login to Quarx and add a home page.</p>
        <p>The basic template is also able to display the main menu by default.</p>
        <h3>Custom Templates</h3>
        <p>By default the homepage has its own template but you can add any by following these details:</p>
        <p>To create custom templates for different purposes simply make a view in <br>
            the `resources/views/quarx/pages` directory that looks similar to: `xxxx-template.blade.php`. <br>
            This means you still have full control of blade templating but your pages can easily swap out views.</p>
        <h3>Widgets & Menus & Images</h3>
        <p>Widgets are easy to add to any template since they can be injected with the `Quarx::menu('xxxx')`, <br>
            `Quarx::widget('xxxx')` or `Quarx::images('tag')`. If you don't suppy a tag for the images you will get<br>
            all images.</p>
        <br>
    @endif

@endsection

@section('quarx')
    @if (isset($page))
        {!! Quarx::editBtn('pages', $page->id) !!}
    @endif
@endsection