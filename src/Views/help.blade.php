@extends('cms::layouts.dashboard')

@section('pageTitle') Help @stop

@section('content')

    <div class="col-md-12 mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-dark card-help">
                    <div class="card-header"><b>Resource History aka. Rollback and Revert</b></div>
                    <div class="card-body">
                        With many of the Grafite CMS modules you can perform a Rollback or Revert to an earlier moment in history. In pages for example if you click Rollback, you will go back to the most recently saved version of the post. However, you can only go back once, or rather undo, it does not keep digging through history. If you would like to go further back, visit the pages History and you will find different edits, you can revert to any of these with just a single click.
                    </div>
                </div>

                <div class="card card-dark card-help">
                    <div class="card-header"><b>Published Assets</b></div>
                    <div class="card-body">
                        Grafite CMS publishes views and controllers within your application. This allows you to control everything you want. You will find the controllers in: <code>app/Http/Controllers/Cms</code> and the views in: <code>resources/themes</code>. There is also the cms config which is added to your app's config directory.
                        <br><br>
                        Grafite CMS will also be able to generate custom modules which you can find in the following directory: <code>cms/modules</code>
                        <br><br>
                        To generate these files simple run:
                        <br><br>
                        <pre>php artisan vendor:publish</pre>
                    </div>
                </div>

                <div class="card card-dark card-help">
                    <div class="card-header"><b>Multilingual</b></div>
                    <div class="card-body">
                        CMS is fully multilingual all you need to do is set the languages in your <code>config/cms.php</code> file and then in your app just set the <code>locale</code> and poof! you have multi-language support.
                    </div>
                </div>

                <div class="card card-dark card-help">
                    <div class="card-header"><b>API Endpoints</b></div>
                    <div class="card-body">
                    Grafite CMS comes with a very basic API. It provides access to all published public facing data. You can define details in your CMS API middleware.
                    <br><br>
                    Out of the box Grafite CMS API requires use of the <code>api-token</code> set in the config of your app.
                    <br><br>
                    All requests should have the following added to the url: <code>?token={config.cms.apiToken}</code>
                    <br><br>
                    <pre>/cms/api/blog
/cms/api/blog/{id}
/cms/api/events
/cms/api/events/{id}
/cms/api/promotions
/cms/api/promotions/{id}
/cms/api/faqs
/cms/api/faqs/{id}
/cms/api/files
/cms/api/files/{id}
/cms/api/images
/cms/api/images/{id}
/cms/api/pages
/cms/api/pages/{id}
/cms/api/widgets
/cms/api/widgets/{id}</pre>
                    </div>
                </div>

                <div class="card card-dark card-help">
                    <div class="card-header"><b>Console Commands</b></div>
                    <div class="card-body">
                        Grafite CMS comes with a few console commands to handle things like module building and publishing
                        <br><br>
                        You can also build simple modules which will run inside CMS. Simply provide a table name you wish to manage and allow CMS to build a CRUD structure that works inside Grafite CMS's module directory.
                        <br><br>
                        You need to add the following line in the autoload PSR-4 group to your composer file to ensure that all modules will work correctly:
                        <br><br>
                        <pre>"Cms\\Modules\\": "cms/modules/",</pre>
                    </div>
                </div>

                <div class="card card-dark card-help">
                    <div class="card-header"><b>Modules: Generate</b></div>
                    <div class="card-body">
                        The commmand for generating custom modules for the Grafite CMS is:
                        <br><br>
                        <pre>php artisan module:crud {name} {--schema="id:increments,name:string"}</pre>
                        <pre>php artisan module:make {name}</pre>
                        <br>
                        The migration option will generate a migration file that can be found in the module. You will then need to run the module migrate to get the module to run its migration course.
                        <br><br>
                        <pre>"Cms\\Modules\\": "cms/modules/",</pre>
                    </div>
                </div>

                <div class="card card-dark card-help">
                    <div class="card-header"><b>Modules: Composer and Publish</b></div>
                    <div class="card-body">
                        Grafite CMS lets you create a composer package from a module. So if you want to can offer them to others rather easily.
                        <br><br>
                        <pre>php artisan module:composer {module} {namespace}</pre>
                        <br>
                        You can also publish assets that belong to a module. So in the chance you wish to build your own modules for future projects you can easily publish specific assets to any applications you build.
                        <br><br>
                        <pre>php artisan module:publish {module}</pre>
                    </div>
                </div>

                <div class="card card-dark card-help">
                    <div class="card-header"><b>Front-End Code: Helpers</b></div>
                    <div class="card-body">
                        Grafite CMS automatically builds you a sample of the controllers, and views for your application's pages, blog, faqs, etc. You can run the following services as method calls or use the blade directives listed below:
                        <br><br>
                        <pre>Cms::widget('slug') // Renders the widget</pre>
                        <pre>Cms::menu('slug', 'custom-view-path') // Renders the menu</pre>
                        <pre>Cms::images('tag') // Outputs an array of images with matching tags if no tag defined all images are returned</pre>
                        <br>
                        You can also publish assets that belong to a module. So in the chance you wish to build your own modules for future projects you can easily publish specific assets to any applications you build.
                        <br><br>
                        <pre>php artisan module:publish {module}</pre>
                    </div>
                </div>

                <div class="card card-dark card-help">
                    <div class="card-header"><b>Front-End Code: Custom Templates</b></div>
                    <div class="card-body">
                        By default the homepage has its own template but you can add any by following these details: To create custom templates for different purposes simply make a view in the <code>resources/themes/{theme}/{module}</code> directory that looks similar to: <code>xxxx-template.blade.php</code>. This means you still have full control of blade templating but your pages can easily swap out views.
                    </div>
                </div>

                <div class="card card-dark card-help">
                    <div class="card-header"><b>Front-End Code: Blade Components</b></div>
                    <div class="card-body">
                        By default the Grafite CMS has the default theme. You can override this in the <code>config/cms.php</code> file. The theme has the namespace of: <code>cms-frontend::</code>, and has some <b>Blade</b> directives such as:
                        <br><br>
                        <pre>&#64;theme('path') // includes file within the theme path</pre>
                        <pre>&#64;menu('slug') // menu rendering</pre>
                        <pre>&#64;modules() // module url links</pre>
                        <pre>&#64;widget('slug') // widget contents</pre>
                        <pre>&#64;promotion('slug') // promotion contents</pre>
                        <pre>&#64;image('id', 'class') // an image HTML tag</pre>
                        <pre>&#64;image_link('id') // an image url</pre>
                        <pre>&#64;images('tag') // images</pre>
                        <pre>&#64;edit('module', 'id') // a link to edit a module or item on the front-end of the site</pre>
                        <br>
                        You can generate new themes and publish thier public assets. Consult the <a target="_blank" href="https://docs.grafite.ca/cms/themes">documentation</a> for more information about themes etc.
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
