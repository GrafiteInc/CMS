var elixir = require('laravel-elixir');

elixir.config.publicPath = 'src/Assets/dist/';
elixir.config.assetsPath = 'src/Assets/src/';

elixir(function(mix) {
    mix.styles([
        '../vendor/dropzone/basic.css',
        '../vendor/dropzone/dropzone.css',
        '../vendor/redactor/redactor.css',
        '../vendor/datepicker/bootstrap-datetimepicker.css',
        '../vendor/raw.min.css'
    ], 'src/Assets/dist/css/vendor.css');

    mix.sass('cms.scss');

    mix.scripts([
        'cms.js',
        'forms.js',
        'dashboard.js',
        'modules.js',
        'dropzone-custom.js',
    ], 'src/Assets/dist/js/cms.js');

    mix.scripts([
        'vendor/typeahead.bundle.js',
        'vendor/bootstrap-tagsinput.min.js',
        'vendor/sortable.min.js',
        '../vendor/dropzone/dropzone.js',
        '../vendor/datepicker/moment.js',
        '../vendor/datepicker/moment-timezone.js',
        '../vendor/datepicker/bootstrap-datetimepicker.min.js',
        '../vendor/redactor/redactor.js',
        '../vendor/redactor/filemanager.js',
        '../vendor/redactor/fontcolor.js',
        '../vendor/redactor/fontfamily.js',
        '../vendor/redactor/fontsize.js',
        '../vendor/redactor/imagemanager.js',
        '../vendor/redactor/stockimagemanager.js',
        '../vendor/redactor/specialchar.js',
        '../vendor/redactor/table.js',
        '../vendor/redactor/video.js',
        '../vendor/redactor/insertIcon.js',
    ], 'src/Assets/dist/js/vendor.js');
});
