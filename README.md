# Grafite CMS

> Grafite has archived this project and no longer supports or develops this code. We recommend using only as a source of ideas for your own code.

**CMS** - Add a CMS to any Laravel app to gain control of: pages, blogs, galleries, events, custom modules, images and more.

[![Build Status](https://travis-ci.org/GrafiteInc/CMS.svg?branch=master)](https://travis-ci.org/GrafiteInc/CMS)
[![Packagist](https://img.shields.io/packagist/dt/grafite/cms.svg?maxAge=2592000)](https://packagist.org/packages/grafite/cms)
[![license](https://img.shields.io/github/license/mashape/apistatus.svg?maxAge=2592000)](https://packagist.org/packages/grafite/cms)

Grafite CMS is a full fledged CMS that can be added to any Laravel application. It provides you with full control of things like: pages, menus, links, widgets, blogs, events, faqs etc.
Grafite CMS comes with a module builder for all your custom CMS needs, as well as a module publishing tools. So if you decide to reuse some modules on future projects you can easily publish thier assets seamlessly. If you wish to make your Grafite CMS module into a PHP package, then you will need to have it publish its assets to the `cms/modules` directory.

### What is simple vs complex setup?
Simple setup uses Grafite Builder as the backbone of an app for you using Laravel, once the setup command has been run you will have a full CMS as an app. Complex setup is specifically for developers who want to add a CMS to their existing app.

##### Author(s):
* [Matt Lantz](https://github.com/mlantz) ([@mattylantz](http://twitter.com/mattylantz), mattlantz at gmail dot com)

## General Requirements
1. PHP 7.1.3+
1. MySQL 5.7+
2. OpenSSL

## Compatibility and Support
| Laravel Version | Package Tag | Supported |
|-----------------|-------------|-----------|
| 5.8.x | 3.3.x | no |
| 5.7.x | 3.x.x | no |
| 5.6.x | 3.0.x | no |
| 5.5.x | 2.4.x | no |
| 5.4.x | 2.3.x | no |

## Documentation

### Installation

Create a new Laravel application, and make a database somewhere and update the .env file.

* Run the following command:

```bash
composer require grafite/cms
```

* Then run the vendor publish:

```bash
php artisan vendor:publish --provider="Grafite\Cms\GrafiteCmsProvider"
```

!!! Tip "If you wish to use the publish datetime picker - set your app's timezone config to correspond with your location"

## Simple Setup

!!! warning "The simple setup requires a fresh Laravel application."

If you're looking to do a simple website with a powerful CMS, and the only people logging on to the app are the CMS managers.
Then you can run the setup command, it will install everything it needs, run its migrations and give you a login to start with.
Take control of your website in seconds.

```php
php artisan grafite:cms-setup
```

Now you're done setup. Login, and start building your amazing new website!

You can login as an admin with the following credentials:

```
U: admin@example.com
P: admin
```

## Complex Setup

!!! warning "Complex setup is needed for applications that have already have existing code including the login/logout set up."

If you just want to add Grafite CMS to your existing application and already have your own application running then follow the instructions below:

* Add the following to your routes provider:

```php
require base_path('routes/cms.php');
```

* Add the following to your app.scss file, you will want to modify depending on your theme of choice.

```css
@import "resources/themes/default/assets/sass/_theme.scss";
```

* Then migrate:

```bash
php artisan migrate
```

* Then add to the Kernel Route Middleware:

```php
'cms' => \App\Http\Middleware\GrafiteCms::class,
'cms-api' => \App\Http\Middleware\GrafiteCmsApi::class,
'cms-language' => \App\Http\Middleware\GrafiteCmsLanguage::class,
'cms-analytics' => \Grafite\Cms\Middleware\GrafiteCmsAnalytics::class,
```

In order to have modules load as well please edit the autoload psr-4 portion to your composer file:
```json
"autoload": {
    ...
    "psr-4": {
        "App\\": "app/",
        ...
        "Cms\\": "cms/"
        }
}
```

## CMS Access
Route to the administration dashboard is "/cms/dashboard".

Grafite CMS requires Grafite Builder to run (only for the FormMaker), but Grafite CMS does not require you to use the Grafite Builder version of roles. But you will still need to ensure some degree of control for Grafite CMS's access. This is done in the Grafite CMS Middleware, using the gate and the Grafite CMS Policy. If you opt in to the roles system provided by Grafite Builder, then you can replace 'cms' with admin to handle the Grafite CMS authorization, if not, you will need to set your own security policy for access to Grafite CMS. To do this simply add the Grafite CMS policy to your `app/Providers/AuthServiceProvider.php` file, and ensure that any rules you wish it to use are in within the policy method. We suggest a policy similar to below.

Possible CMS Access Policy:
```
Gate::define('cms', function ($user) {
    return (bool) $user;
});

Gate::define('cms-api', function ($user) {
    return true;
});
```

Or Using Grafite Builder:
```
Gate::define('cms', function ($user) {
    return ($user->roles->first()->name === 'admin');
});
```

### Fun Route Trick

If you're looking for clean URL pages without having to have the URL preceed with `page` or `p` then you can
add this to your routes.

> Make sure you put it at the bottom of the routes or it may conflict with others.

```php
Route::get('{url}', function ($url) {
    return app(App\Http\Controllers\Cms\PagesController::class)->show($url);
})->where('url', '([A-z\d-\/_.]+)?');
```

### Roles & Permissions (simple setup only)

With the roles middleware you can specify which roles are applicable separating them with pipes: `['middleware' => ['roles:admin|moderator|member']]`.

The Grafite CMS middleware utilizes the roles to ensure that a user is an 'admin'. But you can elaborate on this substantially, you can create multiple roles, and then set their access in your app, using the roles middleware. But, what happens when you want to allow multiple roles to access the CMS but only allow Admins to access your custom modules? You can use permissions for this. Similar to the roles middleware you can set the permissions `['middleware' => ['permissions:admin|cms']]`. You can set custom permissions in `config/permissions.php`. This means you can set different role permissions for parts of your CMS, giving you even more control.

## API Endpoints

Grafite CMS comes with a collection of handy API endpoints if you wish to use them. You can define your own policies for access and customize the middleware as you see fit.

#### Token

The basic Grafite CMS API endpoints must carry the Grafite CMS `apiToken` defined in the config for the app. This can be provided by adding the following to any request:

```
?token={your token}
```

** All published and public facing data will be available via the API by default.

```
/cms/api/blog
/cms/api/blog/{id}
/cms/api/events
/cms/api/events/{id}
/cms/api/faqs
/cms/api/faqs/{id}
/cms/api/files
/cms/api/files/{id}
/cms/api/images
/cms/api/images/{id}
/cms/api/pages
/cms/api/pages/{id}
/cms/api/widgets
/cms/api/widgets/{id}
```

## Images

Images are resized on upload for a better quality response time. They follow the guidelines specified in the `config` under `cms.max-image-size`.

## S3

Regarding S3 bucket usage. You will need to set the permissions accordingly to allow images to be saved to your buckets. Then you need to set your buckets to allow public viewing access.
This is an example of such a policy.

```
{
    "Version":"2008-10-17",
    "Statement":[{
        "Sid":"AllowPublicRead",
        "Effect":"Allow",
        "Principal": {
            "AWS": "*"
        },
        "Action":["s3:GetObject"],
        "Resource":["arn:aws:s3:::MY_BUCKET/public/images/*"]
    }]
}
```

Replace `MY_BUCKET` with your bucket name.

## FileSystem Config

If using S3 you will need to add the following line to your filesystem config: `'visibility' => 'public',`

Also Provides
------
The Grafite CMS package also provides the following packages:

* DevFactory/Minify
* Grafte/Builder

### Config

Grafite CMS has a rather elaborate config with many options available. You can expand the core modules, enable / disable features, and configure so much more.

| Key | Description |
| ------ | ----- |
| analytics | Choose an analytics engine for the dashboard (internal or google) |
| pixabay | Your pixabay API code |
| db-prefix | Add a prefix to the Grafite CMS content tables |
| live-preview | Preview your site in the editor view |
| frontend-namespace | Sets the default namespace for the frontend code |
| frontend-theme | The theme for the frontend |
| load-modules | Do you want to load the external modules |
| module-directory | Directory for custom Grafite CMS modules |
| active-core-modules | Which core Grafite CMS modules are active |
| rss | A set of attributes which can be set for the RSS feed |
| site-mapped-modules | The module urls and their repositories that build the site map XML |
| auto-translate | Automatically translate your content to other languages with Google Translate |
| default-language | Your website's default language |
| languages | Languages available in your website (enables their tabs in the editor) |
| storage-location | Storage for files/ images (s3 or local) |
| max-file-upload-size | The maximum file size for upload (Must also be set in php.ini) |
| preview-image-size | When uploading images we cache clones at a smaller size (default: 800) |
| cloudfront | Set a cloudfront URL to swap for the S3 bucket link |
| backend-title | A title for the CMS (default: cms) |
| backend-route-prefix | The route prefix for the backend of the CMS (default: cms) |
| backend-theme | Theme for the backend (standard|dark) |
| registration-available | Enable or disable registration |
| pagination | Results per pack in backend |
| api-key | Api Key for the Redactor photo and file injection |
| api-token | Api Token for the Redactor photo and file injection, and the general external API calls |
| forms | Forms config for core modules |

### API

Grafite's CMS API is very simple, and it has a VERY simple auth system using a single token which can be defined with in your env. You can easily use this to manage integration with various platforms etc.
The general base route for all API requests is:

```
/cms/api/{resource-url}?token={CMS_API_TOKEN}
```

| URL | Resource |
| ------ | ----- |
| blog | Blog |
| events | Events |
| endorsements | Endorsements |
| faqs | FAQs |
| files | Files |
| images | Images |
| pages | Pages |
| widgets | Widgets |

Each of these routes can be called or, you can also get a specific resource instance with the ID:

Example:
```
/cms/api/blog/1?token=9a78sd6f9as6df9
```

### Multilingual

Translations
-----
All too often we need translations in our sites and even our apps. Grafite CMS has got a very simple way of handling multiple languages. Translations is set up so that in the config if you add any languages to the `languages` array you will be able to define custom entries for those languages.

#### Auto-Translate

```php
auto-translate: false
```

In order to enable the auto-translate ensure that it is set to true in your config.

## Translatable Modules

Simply add the translatable trait to your module's model and then update your modules to follow a similar pattern to the Grafite CMS pages structure see the following files for reference:

```
Grafite\Cms\Controllers\PagesController
Grafite\Cms\Repositories\PageRepository
Grafite\Cms\Models\Page
```

#### Archiving and Clean up:

You will need to extend `CmsModel` rather than the default Model. It will also need to use the `Translatable` Trait.

```
use Grafite\Cms\Models\CmsModel;
use Grafite\Cms\Traits\Translatable;

class Books extends CmsModel
{
    use Translatable;
}
```

You will also need to set bindings similar to this in your module event provider.

```
'eloquent.saved: Grafite\Cms\Models\Page' => [
    'Grafite\Cms\Models\Page@afterSaved',
],
'eloquent.created: Grafite\Cms\Models\Page' => [
    'Grafite\Cms\Models\Page@afterCreate',
],
'eloquent.deleting: Grafite\Cms\Models\Page' => [
    'Grafite\Cms\Models\Page@beingDeleted',
],
```

These bindings ensure that when you save you create an archive of the previous entry, and on deleting of a item the system clears out any translations and archives it left behind.
The created binding allows for the auto-translate so you can utilize the power of Google Translate.

## Language Links

Grafite CMS comes with a blade directive which generates links for your supported languages and provides a simple way to swap between the languages of a single page or blog entry while remaining on the same URL.

## Supporting Language URL Prefixes

By default we support the use of cookies to handle languages and swapping them. Since each page/blog/event etc can have a specific url relative to its language with this current build there isn't much point to the prefixes for languages. But, that being said, sometimes its handy so here is an easy way to add support for it.

Just add this code to the `map()` method in the `RouteServiceProvider.php`:

```php
$segments = request()->segments();
$supportedLanguages = array_keys(config('cms.languages'));

if (isset($segments[0]) && in_array($segments[0], $supportedLanguages)) {
    $language = $segments[0];
    unset($segments[0]);
    return redirect(implode('/', $segments))->withCookie('language', encrypt($language))->send();
}
```

### Promotions

Much like the term implies promotions are like advertisements. They are intended to be treated like widgets, the main difference is that they have time scopes. This means you can put together promotional materials and content and set their publish date and time, as well as a finished at date and time to have the promotion disappear. This makes it very easy to schedule launches of campaigns etc.

```
@promotion('slug')
```

You can set these on any theme files. We recommend you leave them in the theme files and simply change the content and dates when you need to.

### Themes

Grafite CMS has a full scope theming tool built right in. You can easily generate basic themes that can be built on and kept clear of your views.
All the listed templates with a star are optional - otherwise everything else is required, for the basic support.

Basic Theme Structure
------
* assets
    * js
        * theme.js
    * sass
        * _basic.scss <span class="fa fa-star"></span>
        * _theme.scss
* blog
    * all.blade.php
    * featured-template.blade.php
    * show.blade.php
* events
    * all.blade.php
    * date.blade.php
    * calendar.blade.php
    * featured-template.blade.php
    * show.blade.php
* faqs
    * all.blade.php
* gallery
    * all.blade.php
    * show.blade.php
* layout
    * master.blade.php
* pages
    * all.blade.php
    * featured-template.blade.php
    * home.blade.php
    * show.blade.php
* partials
    * navigation.blade.php
* public
    * img

You have the ability to include other theme views into your view using the <code>&#64;theme('path')</code> directive with Blade. Otherwise its basically anything and everything Blade can do including any directives you wish to expand it with.

### Blade Directives

Grafite CMS has some custom directives added to Blade which allows you to include files from your theme easily, as well as other parts.

#### &#64;theme('path.to.view')
You can always add the <code>cms-frontend::</code> namespace to the <code>&#64;include('path')</code> or instead use <code>&#64;theme('path')</code>.

#### &#64;block('slug')

Create unique and elegant designs with block directives in your templates for pages and blogs.

!!! Warning
    With the block blade directive you do not specify the module it needs to load, it determines that from the first string in the request URL.
    It will default to page if no matching module name matches the URL. In the case of something like `events`, it expects the variable in the template
    to be `$event`. It is wrapped in the `optional` method to protect the view from breaking the app.

#### &#64;menu('slug')

Easily add menus to your views with the menu blade directive.

#### &#64;modules(['modules-to-ignore'], 'link-class', 'list-item-class')

Generate links to modules automatically (Bootstrap 4 by default).

#### &#64;widget('slug')

Add widgets to your views with the menu blade directive, just specify the SLUG.

#### &#64;image('id', 'class')

Provides an image URL with an html tag and extra for adding a class

#### &#64;image_link('ID')

Provides an image URL

#### &#64;images('tag')

Images will be provided as an array, and if you skip the tag then the method will return all images, otherwise it follows the tagging.

#### &#64;edit('module', 'id')

There is also the Grafite CMS Service which can be run inside your blade views. Its as simple as {{ Cms::method() }}

#### &#64;markdown('content')

Convert your markdown blog or page entries into HTML.

#### &#64;languages('link-class', 'list-item-class')

Generate links for each supported lanugage in your website

Helper Methods Available:
------
* menu('slug', 'optional-view-path')
* images('tag')
* widget('slug')
* editBtn('module', 'id')

### Pages and Blocks

There are some special features for pages which are not available for other parts of the site.

#### Blocks

Pages are special and can often require complex designs. If your application needs some of the more abstract designs you can still use Grafite CMS for page management by using the block system.

```php
{!! $page->block('main') !!}
```
or
```
{{ block('main') }}
```

By placing code like this in your template Grafite CMS will generate the `main` block if it does not exist yet. If it does and has content it will render the content. It's really that simple.

### Publishing

#### Command
```
php artisan theme:publish {name}
```

The Grafite CMS theme publisher will publish the public directory only. If you want to integrate assets you need to do so using your `webpack` or `gulp` file, pending on which setup you use.

| Laravel Verison | Asset builder |
| --- | --- |
| 5.4+ | `webpack.mix.js` |
| 5.3 | `gulpfile.js` |

Basic Theme (top tier)
------
* assets
* blog
* events
* faqs
* gallery
* layout
* pages
* partials
* public
    * img

### Symlink

#### Command
```
php artisan theme:link {name}
```

The Grafite CMS theme link tool will create a symlink between your public folder and a folder in your public directory called `theme`.
This can make it easier to manage assets within a theme.

| Laravel Verison | Asset builder |
| --- | --- |
| 5.4+ | `webpack.mix.js` |
| 5.3 | `gulpfile.js` |

Basic Theme (top tier)
------
* assets
* blog
* events
* faqs
* gallery
* layout
* pages
* partials
* public -> `{app_directory}/public/theme`
    * img

### Modules

Grafite CMS comes with a handful of modules for handling a basic application/website including: Images, Files, Blog, Pages, Faqs, etc.
Below you will find a full listing of the modules that come pre-packaged with Grafite CMS.
In order to create your own Modules and ensure that they are loaded you MUST add `"Cms\\": "cms/"` to the PSR-4 group in your `composer.json` file.

Pre-packaged Modules
------
* Blog
* Pages
* Menus
* Widgets
* Faqs
* Images
* Files
* Events

You have the freedom to make any modules you want. You can use the `artisan module:make` or the `artisan module:crud` to generate them and then `artisan module:publish` to publish their contents.

### Assets

Grafite CMS modules have an `Assets` directory which is intended to contain all your JS and SASS or CSS. In order to load the Assets in your Module, you can use the `Cms` facade.

Grafite CMS comes with a Minify package so you can easily load your modules assets with calls like below. You don't have to set the content-type.
But pending on what you're loading you may want to override what the Cms service determines is the content-type.

So if you want to load your css file in your Sample module's Assets you could do the following:

`Assets/css/styles.css` is the file we're grabbing.

```
<link rel="stylesheet" type="text/css" href="{{ Cms::moduleAsset('sample', 'css/styles.css', 'text/css') }}">
```

Or we can load some JavaScript, and yes jQuery is already inside Grafite CMS.

`Assets/js/module.js` is the file we're grabbing.

```
<script type="text/javascript" src="{{ Cms::moduleAsset('sample', 'js/module.js', 'application/javascript') }}"></script>
```

### Composer

So now you've made a CMS module and it's serving your application well, but now you've decided that it would make more sense for it to be a composer package, that you can run inside any app for easier maintenance. This also gives you far more freedom to decide how you wish to integrate the module into your app.

```
module:composer {name} {namespace}
```

This will generate a composer file, as well set the namespace of your module to a new package namespace.

### Config

The configs are autoloaded and are added to the cms config.

```
config('cms.modules.sample') // would retrieve the sample modules internal config.php contents
```

If you want to access a config that is customizable for your module you can publish one:

```
php artisan vendor:publish
```

### CRUD

Grafite CMS can generate custom CRUD modules for your application giving it all the power you want as fast as possble. Simply run the command: `php artisan module:crud` and discover the many hidden powers inside the Grafite CMS.
The CRUD generator will produce a module with basic unit tests started. You would then need to setup your migrations etc, and then publish the module to your app. Check out the publishing for more details.

#### Forms
You can use the Form Maker tool which is provided by [Grafite Builder](https://github.com/GrafiteInc/Builder)

#### Redactor
You can utilize redactor (the WYSIWYG) in your CRUD by adding `.redactor` to any textarea class.

#### Images and Files:
Inside the redactor instance you can easily add images and files which you have uploaded to Grafite CMS. Its as easy as clicking them to have them added to the entry.

#### Front-end/ Theme
When you generate a module the system will also generate a front-end or theme component which is kept in the `Publishes` directory. The is the portion of code that your visitors will see. You will need to publish this code using the `php artisan module:publish {name}` command.
Provided you leave the module inside the `cms/modules` directory. However, you can also make your module into a composer package.

### Files &amp; Images

Grafite CMS is always concerned with security of what you provide, the potential open doors in your website/ app. As such, the Files which are uploaded to the CMS are locked outside of the public access points.

*What does this mean?*

This means that when you're website is providing these to visitors they are actually getting them through an API access point. This is done to ensure that the files do not reveal thier location. This means that no webscrappers can crawl your directories and take off files they shouldn't be, including files that have yet to be released.

#### Storage Location

In the config you can set the storage location for your file uploads. This can be either S3 or local. To get S3 to work correctly you need to configure Laravel as you would with S3. Grafite CMS will take it from there. So simply add your details to the config and it should work. The CMS loads all the third-party packages you will need.

### Make

Grafite CMS has a powerful CRUD builder. But lets say you want to have a custom module that integrates with another service or doesn't involve a CRUD at all.
Then the `php artisan module:make` command will be your best tool. It will create a minimum viable module with a very basic admin layer and client layer which you can customize as you see fit.

#### Redactor
You can utilize redactor in your module by adding `.redactor` to any textarea class.

#### Images and Files:
Inside the redactor instance you can easily add images and files which you have uploaded to the CMS. Its as easy as clicking them to have them added to the entry.

#### Front-end/ Theme
When you generate a module the system will also generate a front-end or theme component which is kept in the `Publishes` directory. The is the portion of code that your visitors will see. You will need to publish this code using the `php artisan module:publish {name}` command.

### Publish

All custom modules will need to have their `Publishes` folder published in order to have their code added to you app. We've wrapped this into one simple command:

```
php artisan module:publish
```

Running this will place the files in the matching folders in your app. So if you want to have files put in migrations make sure your `Publishes` folder has a migration file in a directory like this:

```
Publishes/database/migrations/migration_file.php
```

If you switch themes in Grafite CMS you will need to republish your module. The views are added directly into the themes.

## License
Grafite CMS is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

## Redactor License
Grafite has an OEM licence for the use of Redactor in the Grafite CMS package.
You are fully welcome to use Grafite CMS package and incorporate it into any apps you build, you are permitted to offer those apps as SaaS or other products.
However, you are not entitle to strip out parts of Redactor and resell them, please see this [license](https://imperavi.com/redactor/license/) for more information

### Bug Reporting and Feature Requests
Please add as many details as possible regarding submission of issues and feature requests

### Disclaimer
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
