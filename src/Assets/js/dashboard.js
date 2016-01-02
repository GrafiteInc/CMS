/*
|--------------------------------------------------------------------------
| Menu Highlighter
|--------------------------------------------------------------------------
*/

$('.nav-sidebar li').each(function(){
    if ($(this).children('a').text().toLowerCase().trim() == $('.page-header').text().toLowerCase().trim()) {
        $(this).addClass('active');
    }
});

/*
|--------------------------------------------------------------------------
| Dashboard Panel
|--------------------------------------------------------------------------
*/

function _setDashboard () {
    if ($(window).width() < 768) {
        $('.sidebar').css({
            left: '-300px',
        });

        if ($('.sidebar-menu-btn').length === 0) {
            $(".page-header").prepend('<span class="sidebar-menu-btn fa fa-bars raw-margin-right-16"></span>');
        }

        $('.sidebar-menu-btn').unbind().bind('click', function(){
            $('.overlay').fadeIn()
            $('.sidebar').animate({
                left: 0
            }, 'fast');
        });
        $('.overlay').unbind().bind('click', function(){
            $('.overlay').fadeOut();
            $('.sidebar').animate({
                left: '-'+$(window).width()+'px',
            }, 'fast');
        });
    } else {
        $('.sidebar-menu-btn').remove();
        $('.sidebar').css({
            left: 0
        });
    }
}
