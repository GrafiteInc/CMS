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
        <p>To create custom templates for different purposes simply make a file in the `resources/themes/default/{module-name}` directory that looks similar to: `xxxx-template.blade.php`. This means you still have full control of blade templating but your modules can easily swap out templates.</p>

        <h3>Widgets, Menus, Images and Includes</h3>
        <p>Widgets are easy to add to any template since they can be injected with the `&#64;menu('xxxx')`, `&#64;widget('xxxx')` or `&#64;images('tag')`. If you don't supply a tag for the images you will get all images. You can also include a theme file using the `&#64;theme('path.in.theme')`</p>
        <br>
    @endif

@endsection

@section('quarx')
    @if (isset($page))
        @edit('pages', $page->id)
    @endif
@endsection