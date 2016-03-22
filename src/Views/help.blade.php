@extends('quarx::layouts.dashboard')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header text-center">Help</h1>

            <h2>Published Assets</h2>
            <p>Quarx publishes views and controllers within your application. This allows you to control everything you want. You will find the controllers in: <code>app/Http/Controllers/Quarx</code> and the views in: <code>resources/themes</code>. There is also the quarx config which is added to your app's config directory.</p>
            <p>Quarx will also be able to generate cutom modules which you can find in the following directory: <code>quarx/modules</code></p>
            <p>To generate these files simple run:</p>
<pre>
php artisan vendor:publish
</pre>
            <p></p>

            <h2>Console Commands</h2>
            <p>Quarx comes with a few console commands to handle things like migrations and module building should you wish to expand it.</p>
            <p>Migrations are a key aspect of a great application. You only need to run the migrate once when you first setup Quarx in your application. Any other times you wish to run it for your own modules simply add the module name to the command and run your migrations in there if you wish to keep the module separate from your core application.</p>

        <h3>Migrations</h3>

<pre>
php artisan quarx:migrate {module name}
</pre>

<p>You can also build simple modules which will run inside Quarx. Simply provide a table name you wish to manage and allow Quarx to build a CRUD structure that works inside Quarx's module directory.</p>
<p>You need to add the following line in the autoload PSR-4 group to your composer file to ensure that all modules will work correctly:</p>
<pre>
"Quarx\\": "quarx/",
</pre>

        <h3>Modules</h3>
<p>The commmand for generating custom modules for Quarx is:</p>

<pre>
php artisan quarx:module {name} {--migration}
</pre>

        <p>The migration option will generate a migration file that can be found in the module. You will then need to run the module migrate to get the module to run its migration course.</p>

        <h3>Publish</h3>
        <p>Quarx also lets you publish assets that belong to a module. So in the chance you wish to build your own modules for future projects you can easily publish specific assets to any applications you build.</p>

<pre>
php artisan quarx:publish {module}
</pre>

        <h2>Front-End Code</h2>
        <p>Quarx automatically builds you a sample of the controllers, and views for your application's pages, blog, faqs, etc. There are two main method calls available outside of the standard Laravel methods:</p>

<pre>
Quarx::widget('uuid') // Renders the widget
</pre>

<p>and</p>

<pre>
Quarx::menu('uuid', 'custom-view-path') // Renders the menu
</pre>

<p>and</p>

<pre>
Quarx::images('tag') // Outputs an array of images with matching tags if no tag defined all images are returned
</pre>

        <h2>Custom Templates</h2>
        <p>By default the homepage has its own template but you can add any by following these details: To create custom templates for different purposes simply make a view in the <code>resources/themes/pages</code> directory that looks similar to: <code>xxxx-template.blade.php</code>. This means you still have full control of blade templating but your pages can easily swap out views.</p>

        <h2>Custom Themes</h2>
        <p>By default the Quarx has the default theme. You can override this in the <code>config/quarx.php</code> file. The theme has the namespace of: <code>quarx-frontend::</code>, and has some Blade directives such as:</p>

<pre>
&#64;theme('path')
</pre>
        <p>You can generate new themes and publish thier public assets. Consult the <a target="_blank" href="http://quarx.info/themes">documentation</a> for more information about themes.</p>
    </div>

@stop