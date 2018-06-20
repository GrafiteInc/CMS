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
    $(".cms-notification").attr('class', 'cms-notification');
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
