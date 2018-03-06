var elixir = require('laravel-elixir');

elixir.config.publicPath = 'src/Assets/dist/';
elixir.config.assetsPath = 'src/Assets/src/';

elixir(function(mix) {
    mix.styles([
        '../vendor/dropzone/basic.css',
        '../vendor/dropzone/dropzone.css',
        '../vendor/redactor/redactor.css',
        '../vendor/datepicker/bootstrap-datetimepicker.css',
        'raw.min.css',
        'device.css',
        'main.css',
        'loaders.css',
        'modules.css',
    ]);

    mix.scripts([
        'bootstrap.min.js',
        'cabin.js',
        'forms.js',
        'dashboard.js',
        'typeahead.bundle.js',
        'bootstrap-tagsinput.min.js',
        'sortable.min.js',
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
        'modules.js',
        'dropzone-custom.js',
    ]);
});
