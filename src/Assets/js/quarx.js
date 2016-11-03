
/*
|--------------------------------------------------------------------------
| Generals
|--------------------------------------------------------------------------
*/

$(function() {
    $(".non-form-btn").bind("click", function(e){
        e.preventDefault();
    });

    $(".delete-btn").bind("click", function(e){
        e.preventDefault();
        $('#deleteModal').modal('toggle');
        var _parentForm = $(this).parent('form');
        $('#deleteBtn').bind('click', function(){
            _parentForm[0].submit();
        });
    });

    $(".delete-link-btn").bind("click", function(e){
        e.preventDefault();
        $('#deleteLinkModal').modal('toggle');
        var _parentForm = $(this).parent('form');
        $('#deleteLinkBtn').bind('click', function(){
            _parentForm[0].submit();
        });
    });

    $(".delete-btn-confirm").bind("click", function(e){
        e.preventDefault();
    });

    $('form.add, form.edit').submit(function(){
        $('.loading-overlay').show();
    });

    $('a.slow-link').click(function(){
        $('.loading-overlay').show();
    });

    $(window).resize(function(){
        _setDashboard();
    });

    _setDashboard();
});

/*
|--------------------------------------------------------------------------
| Notifications - Growl Style
|--------------------------------------------------------------------------
*/

function quarxNotify(message, _type) {
    $(".quarx-notification").css("display", "block");
    $(".quarx-notification").addClass(_type);

    $(".quarx-notify-comment").html(message);
    $(".quarx-notification").animate({
        right: "20px",
    });

    $(".quarx-notify-closer-icon").click(function(){
        $(".quarx-notification").animate({
            right: "-300px"
        },"", function(){
            $(".quarx-notification").css("display", "none");
            $(".quarx-notify-comment").html("");
        });
    });

    setTimeout(function(){
        $(".quarx-notification").animate({
            right: "-300px"
        },"", function(){
            $(".quarx-notification").css("display", "none");
            $(".quarx-notify-comment").html("");
        });
    }, 8000);
}

/*
|--------------------------------------------------------------------------
| Twitter Typeahead - Taken straight from Twitter's docs
|--------------------------------------------------------------------------
*/

var typeaheadMatcher = function(strs) {
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
