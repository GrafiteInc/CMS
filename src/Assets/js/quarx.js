
/*
|--------------------------------------------------------------------------
| Generals
|--------------------------------------------------------------------------
*/

$(function() {
    $(".non-form-btn").bind("click", function(e){
        e.preventDefault();
    });

    $('form').submit(function(){
        $('.loading-overlay').show();
    });

    $('a.slow-link').click(function(){
        $('.loading-overlay').show();
    });

    $("#gondolynLoginPanel").bind("click", function(e) {
        e.preventDefault();
        gondolynModal();
        showLoginPanel();
    });

    $(".gondolyn-modal").bind("click", function(){
        $(".gondolyn-modal").fadeOut();
        $(".gondolyn-login").removeClass("gondolyn-login-animate");
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

function gondolynNotify(message, _type) {
    $(".gondolyn-notification").css("display", "block");
    $(".gondolyn-notification").addClass(_type);

    $(".gondolyn-notify-comment").html(message);
    $(".gondolyn-notification").animate({
        right: "20px",
    });

    $(".gondolyn-notify-closer-icon").click(function(){
        $(".gondolyn-notification").animate({
            right: "-300px"
        },"", function(){
            $(".gondolyn-notification").css("display", "none");
            $(".gondolyn-notify-comment").html("");
        });
    });

    setTimeout(function(){
        $(".gondolyn-notification").animate({
            right: "-300px"
        },"", function(){
            $(".gondolyn-notification").css("display", "none");
            $(".gondolyn-notify-comment").html("");
        });
    }, 8000);
}

/*
|--------------------------------------------------------------------------
| Modal Screen
|--------------------------------------------------------------------------
*/

function gondolynModal() {
    $(".gondolyn-modal").fadeIn();
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
