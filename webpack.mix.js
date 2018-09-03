const { mix } = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.config.publicPath = 'src/Assets/dist/';

mix.sass('src/Assets/src/sass/cms.scss', 'css');

mix.scripts([
    'src/Assets/src/js/vendor/typeahead.bundle.js',
    'src/Assets/src/js/vendor/bootstrap-tagsinput.min.js',
    'src/Assets/src/js/vendor/sortable.min.js',
    'src/Assets/src/vendor/dropzone/dropzone.js',
    'src/Assets/src/vendor/datepicker/moment.js',
    'src/Assets/src/vendor/datepicker/moment-timezone.js',
    'src/Assets/src/vendor/datepicker/bootstrap-datetimepicker.min.js',
    'src/Assets/src/vendor/redactor/redactor.js',
    'src/Assets/src/vendor/redactor/_plugins/fileselector/fileselector.js',
    'src/Assets/src/vendor/redactor/_plugins/fontcolor/fontcolor.js',
    'src/Assets/src/vendor/redactor/_plugins/alignment/alignment.js',
    'src/Assets/src/vendor/redactor/_plugins/imageselector/imageselector.js',
    'src/Assets/src/vendor/redactor/_plugins/stockimagemanager/stockimagemanager.js',
    'src/Assets/src/vendor/redactor/_plugins/specialchars/specialchars.js',
    'src/Assets/src/vendor/redactor/_plugins/table/table.js',
    'src/Assets/src/vendor/redactor/_plugins/video/video.js',
    'src/Assets/src/vendor/redactor/_plugins/inserticon/inserticon.js',
], 'src/Assets/dist/js/vendor.js');

mix.scripts([
    'src/Assets/src/js/cms.js',
    'src/Assets/src/js/forms.js',
    'src/Assets/src/js/dashboard.js',
    'src/Assets/src/js/modules.js',
    'src/Assets/src/js/dropzone-custom.js',
], 'src/Assets/dist/js/cms.js');

mix.styles([
    'src/Assets/src/vendor/dropzone/basic.css',
    'src/Assets/src/vendor/dropzone/dropzone.css',
    'src/Assets/src/vendor/datepicker/bootstrap-datetimepicker.css',
    'src/Assets/src/vendor/raw.min.css',
    'src/Assets/src/vendor/redactor/redactor.css'
], 'src/Assets/dist/css/vendor.css');
