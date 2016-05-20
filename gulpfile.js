var elixir = require('laravel-elixir');

elixir.config.publicPath = 'src/Assets/dist/';
elixir.config.assetsPath = 'src/Assets/';

elixir(function(mix) {
    mix.styles([
        'raw.min.css',
        'main.css',
        'loaders.css',
        'quarx-style.css',
        'device-desktop.css',
        'device-tablet.css',
        'device-mobile.css',
        '../packages/redactor/redactor.css',
        '../packages/datepicker/bootstrap-datetimepicker.css',
    ]);
});

elixir(function(mix) {
    mix.scripts([
        'bootstrap.min.js',
        'quarx.js',
        'quarx-script.js',
        'typeahead.bundle.js',
        'bootstrap-tagsinput.min.js',
        '../packages/datepicker/moment.js',
        '../packages/datepicker/bootstrap-datetimepicker.min.js',
        '../packages/redactor/redactor.js',
        '../packages/redactor/filemanager.js',
        '../packages/redactor/fontcolor.js',
        '../packages/redactor/fontfamily.js',
        '../packages/redactor/fontsize.js',
        '../packages/redactor/imagemanager.js',
        '../packages/redactor/stockimagemanager.js',
        '../packages/redactor/specialchar.js',
        '../packages/redactor/table.js',
        '../packages/redactor/video.js',
    ]);
});
