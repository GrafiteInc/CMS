if ($("#External").is(':checked')) {
    $('#External_url').parent().show();
    $('#Page_id').parent().hide();
} else {
    $('#External_url').parent().hide();
    $('#Page_id').parent().show();
}

$(window).ready(function(){
    $("#External").bind('click', function() {
        if ($(this).is(':checked')) {
            $('#External_url').parent().show();
            $('#Page_id').parent().hide();
        } else {
            $('#External_url').parent().hide();
            $('#Page_id').parent().show();
        }
    });
});
