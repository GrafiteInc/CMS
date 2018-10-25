/*
|--------------------------------------------------------------------------
| Grafite CMS
|--------------------------------------------------------------------------
*/

var _redactorConfig = {
    toolbarFixedTopOffset: ($(window).width() < 376) ? 30 : 50,
    visual: true,
    minHeight: 175,
    convertVideoLinks: true,
    imageUpload: false,
    pastePlaintext: true,
    imagePosition: true,
    imageResizable: true,
    deniedTags: ['script'],
    imageManagerJson: _url+'/cms/api/images/list',
    fileManagerJson: _url+'/cms/api/files/list',
    stockImageManagerJson: 'https://pixabay.com/api/',
    formatting: ['p', 'blockquote', 'pre', 'h1', 'h2', 'h3', 'h4', 'h5'],
    buttonsAddAfter: {
        after: 'deleted',
        buttons: [
            'underline'
        ]
    },
    plugins: [
        'table',
        'fontcolor',
        'alignment',
        'specialchars',
        'video',
        'stockimagemanager',
        'fileselector',
        'imageselector',
    ]
};

$(window).load(function() {

    $('.pull-down').each(function() {
        var height = 300 - $(this).siblings('.thumbnail').height() - $(this).height() - 48;
        $(this).css('margin-top', height);
    });

    $('textarea.redactor').redactor(_redactorConfig);
});

$(function () {
    var _initialUrlValue = $('#Url').val();

    function _urlPrepare (title) {
        return title.replace(/[^\w\s]/gi, '').replace(/ /g, '-').toLowerCase();
    }

    $('#Title, #Name').bind('keyup', function () {
        if (_initialUrlValue == '') {
            $('#Url').val(_urlPrepare($(this).val()));
        }
    });

    $('.timepicker').datetimepicker({
        format: 'LT',
        timeZone: _appTimeZone
    });

    $('.datepicker').datetimepicker({
        format: 'YYYY-MM-DD',
        timeZone: _appTimeZone
    });

    $('.datetimepicker').datetimepicker({
        showTodayButton: true,
        format: 'YYYY-MM-DD HH:mm',
        timeZone: _appTimeZone
    });

    $('.tags').tagsinput();
});
