/*
|--------------------------------------------------------------------------
| Quarx JS
|--------------------------------------------------------------------------
*/

var _redactorConfig = {
    toolbar: true,
    minHeight: 175,
    convertVideoLinks: true,
    imageUpload: true,
    buttonSource: true,
    replaceDivs: false,
    pastePlaintext: true,
    deniedTags: ['script'],
    imageManagerJson: _url+'/quarx/api/images/list',
    fileManagerJson: _url+'/quarx/api/files/list',
    stockImageManagerJson: 'http://freepixelstock.com/api/1.0/stock',
    plugins: ['table','video','imagemanager', 'stockimagemanager', 'filemanager', 'specialchar'],
    buttons: ['html', 'formatting', 'bold', 'italic', 'underline', 'deleted', 'unorderedlist', 'orderedlist',
          'outdent', 'indent', 'image', 'filemanager', 'stockimagemanager', 'video', 'link', 'alignment', 'horizontalrule'], // + 'underline'
};

$(window).load(function() {

    $('.pull-down').each(function() {
        var height = 300 - $(this).siblings('.thumbnail').height() - $(this).height() - 48;
        $(this).css('margin-top', height);
    });

    $('textarea.redactor').redactor(_redactorConfig);
});

$(function(){
    function _urlPrepare (title) {
        return title.replace(/[^\w\s]/gi, '').replace(/ /g, '-').toLowerCase();
    }

    $('#Title, #Name').bind('keyup', function() {
        $('#Url').val(_urlPrepare($(this).val()));
    });

    $('.timepicker').datetimepicker({ format: 'LT' });
    $('.datepicker').datetimepicker({
        format: 'YYYY-MM-DD'
    });

    $('.tags').tagsinput();
});
