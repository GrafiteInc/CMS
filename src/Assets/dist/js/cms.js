/*
|--------------------------------------------------------------------------
| Sidebar
|--------------------------------------------------------------------------
*/

$(document).ready(function () {
    $('.alert').delay(7000).fadeOut();

    // toggle sidebar when button clicked
    $('.sidebar-toggle').on('click', function () {
        $('.sidebar').toggleClass('toggled');
    });

    // auto-expand submenu if an item is active
    var active = $('.sidebar .active');

    if (active.length && active.parent('.collapse').length) {
        var parent = active.parent('.collapse');

        parent.prev('a').attr('aria-expanded', true);
        parent.addClass('show');
    }
});


/*
|--------------------------------------------------------------------------
| Generals
|--------------------------------------------------------------------------
*/

$(function () {
    $(".non-form-btn").bind("click", function (e) {
        e.preventDefault();
    });

    $(".delete-btn").bind("click", function (e) {
        e.preventDefault();
        $('#deleteModal').modal('toggle');
        var _parentForm = $(this).parent('form');
        $('#deleteBtn').bind('click', function(){
            _parentForm[0].submit();
        });
    });

    $(".delete-link-btn").bind("click", function (e) {
        e.preventDefault();
        $('#deleteLinkModal').modal('toggle');
        var _parentForm = $(this).parent('form');
        $('#deleteLinkBtn').bind('click', function(){
            _parentForm[0].submit();
        });
    });

    $(".delete-btn-confirm").bind("click", function (e) {
        e.preventDefault();
    });

    $('form.add, form.edit').submit(function(){
        $('.loading-overlay').show();
    });

    $('a.slow-link').click(function(){
        $('.loading-overlay').show();
    });
});

/*
|--------------------------------------------------------------------------
| Notifications - Growl Style
|--------------------------------------------------------------------------
*/

function cmsNotify(message, _type) {
    $(".cms-notification").css("display", "block");
    $(".cms-notification").addClass(_type);

    $(".cms-notify-comment").html(message);
    $(".cms-notification").animate({
        right: "20px",
    });

    $(".cms-notify-closer").click(function(){
        $(".cms-notification").animate({
            right: "-300px"
        },"", function(){
            $(".cms-notification").css("display", "none");
            $(".cms-notify-comment").html("");
        });
    });

    setTimeout(function(){
        $(".cms-notification").animate({
            right: "-300px"
        },"", function(){
            $(".cms-notification").css("display", "none");
            $(".cms-notify-comment").html("");
        });
    }, 8000);
}

/*
|--------------------------------------------------------------------------
| Twitter Typeahead - Taken straight from Twitter's docs
|--------------------------------------------------------------------------
*/

var typeaheadMatcher = function (strs) {
    return function findMatches(q, cb) {
        var matches, substringRegex;

        // an array that will be populated with substring matches
        matches = [];

        // regex used to determine if a string contains the substring `q`
        substrRegex = new RegExp(q, 'i');

        // iterate through the pool of strings and for any string that
        // contains the substring `q`, add it to the `matches` array
        $.each(strs, function(i, str) {
            if (substrRegex.test(str)) {
                matches.push(str);
            }
        });

        cb(matches);
    };
};

/*
|--------------------------------------------------------------------------
| Grafite CMS
|--------------------------------------------------------------------------
*/

var _redactorConfig = {
    toolbar: true,
    visual: true,
    minHeight: 175,
    convertVideoLinks: true,
    imageUpload: true,
    buttonSource: true,
    replaceDivs: false,
    paragraphize: false,
    pastePlaintext: true,
    deniedTags: ['script'],
    imageManagerJson: _url+'/cms/api/images/list',
    fileManagerJson: _url+'/cms/api/files/list',
    stockImageManagerJson: 'https://pixabay.com/api/',
    plugins: ['table','video', 'fontcolor', 'imagemanager', 'stockimagemanager', 'filemanager', 'specialchar', 'insertIcon'],
    buttons: ['html', 'formatting', 'fontcolor', 'bold', 'italic', 'underline', 'deleted', 'unorderedlist', 'orderedlist',
          'outdent', 'indent', 'image', 'filemanager', 'stockimagemanager', 'video', 'link', 'alignment', 'horizontalrule', 'insertIcon'], // + 'underline'
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


/*
 * --------------------------------------------------------------------------
 * General
 * --------------------------------------------------------------------------
*/

$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
});

/*
 * --------------------------------------------------------------------------
 * Links
 * --------------------------------------------------------------------------
*/

if ($('#External').is(':checked')) {
    $('#External_url').parent().show();
    $('#Page_id').parent().hide();
} else {
    $('#External_url').parent().hide();
    $('#Page_id').parent().show();
}

$(window).ready(function(){
    $('#External').bind('click', function() {
        if ($(this).is(':checked')) {
            $('#External_url').parent().show();
            $('#Page_id').parent().hide();
        } else {
            $('#External_url').parent().hide();
            $('#Page_id').parent().show();
        }
    });
});

var linkList = document.getElementById('linkList');

if (typeof linkList != 'undefined' && linkList != null) {
    var sortable = Sortable.create(linkList, {
        store: {
            get: function (sortable) {
                return _linkOrder ? _linkOrder : [];
            },
            set: function (sortable) {
                var _order = sortable.toArray();
                $.ajax({
                    url: _cmsUrl + '/menus/' + _id + '/order',
                    type: 'put',
                    data: {
                        _token: _token,
                        order: JSON.stringify(_order)
                    },
                    success: function (_data) {
                        // do nothing!
                    }
                });
            }
        }
    });
}

/*
 * --------------------------------------------------------------------------
 * Files
 * --------------------------------------------------------------------------
*/

$(function () {
    $('#saveFilesBtn').click(function(e){
        e.preventDefault();
        Dropzone.forElement('.dropzone').processQueue();
    });
});

function confirmDelete (url) {
    $('#deleteBtn').attr('href', url);
    $('#deleteModal').modal('toggle');
}

/*
 * --------------------------------------------------------------------------
 * Images
 * --------------------------------------------------------------------------
*/

$(function () {
    $('#saveImagesBtn').click(function(e){
        e.preventDefault();
        Dropzone.forElement('.dropzone').processQueue();
    });

    $('.selectable').bind('click', function () {
        if (!$(this).hasClass('selected-highlight')) {
            $(this).addClass('selected-highlight');
        } else {
            $(this).removeClass('selected-highlight');
        }
    });

    $('.bulk-image-delete').click(function () {
        var _images = [];
        $('.selected-highlight').each(function () {
            _images.push($(this).attr('data-id'));
        });

        if (_images.length > 0) {
            $('#bulkImageDeleteModal').modal('toggle');
            var _deleteUrl = _url + '/cms/images/bulk-delete/' + _images.join('-')
            $('#bulkImageDelete').attr('href', _deleteUrl);
        }
    });

    $('.img-alter-btn').click(function (e) {
        e.stopPropagation();
    });
});

/*
 * --------------------------------------------------------------------------
 * Previews
 * --------------------------------------------------------------------------
*/

$('.preview-toggle').bind('click', function () {
    if ($(this).attr('data-platform') == 'desktop') {
        $('#frame').css({
            width: '150%'
        });
    }
    if ($(this).attr('data-platform') == 'mobile') {
        $('#frame').css({
            width: '320px'
        });
    }
});

$('#frame').load(function () {
    var frameBody = $('#frame').contents().find('body');
    $('a', frameBody).click(function(e){
        e.preventDefault();
    });
});

/*
 * --------------------------------------------------------------------------
 * Pages and Blocks
 * --------------------------------------------------------------------------
*/

$(function () {
    $('.add-block-btn').bind('click', function (e) {
        e.preventDefault();
        $('#blockName').val('');
        $('#addBlockModal').modal('toggle');
    });

    $('#addBlockBtn').bind('click', function () {
        var _slug = $('#blockName').val();
        $('.blocks').prepend('<div id="block_container_'+_slug+'" class="col-md-12"><div class="form-group"><h4>'+_slug+'<button type="button" class="btn btn-xs btn-danger delete-block-btn pull-right"><span class="fa fa-trash"></span></button></h4><textarea id="block_'+_slug+'" name="block_'+_slug+'" class="form-control redactor"></textarea></div></div>');
        $('#addBlockModal').modal('toggle');
        $('#block_'+_slug).redactor(_redactorConfig);
    });

    $('.delete-block-btn').bind('click', function (e) {
        e.preventDefault();
        $('#deleteBlockBtn').attr('data-slug', $(this).attr('data-slug'));
        $('#deleteBlockModal').modal('toggle');
    });

    $('#deleteBlockBtn').bind('click', function () {
        $('#'+$(this).attr('data-slug')).remove();
        $('#deleteBlockModal').modal('toggle');
    });
});

Dropzone.options.fileDropzone = {
    paramName: "location",
    addRemoveLinks: true,
    autoProcessQueue: false,
    init: function() {
        this.on("success", function(file, responseText) {
            file.serverData = responseText.data;
            $(['name', 'original', 'mime', 'size']).each(function() {
                $("#fileDetailsForm").prepend('<input id="file_'+file.serverData.name+'" name="location['+file.serverData.name+']['+this+']" value="'+file.serverData[this]+'" type="hidden" />');
            });
            this.options.autoProcessQueue = true;
        });
        this.on("queuecomplete", function(){
            $('#fileDetailsForm').submit();
        });
        this.on("removedfile", function(file) {
            if (! file.serverData) {
                return;
            } else {
                $.get(_url+"/cms/files/remove/"+file.serverData.name);
                $("#file_"+file.serverData.name).remove();
            }
        });
    },
    accept: function(file, done) {
        done();
    }
};
//# sourceMappingURL=cms.js.map
