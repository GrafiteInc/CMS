$(document).ready(function(){

    $('.timepicker').datetimepicker({ format: 'LT' });
    $('.datepicker').datetimepicker({
        format: 'YYYY-MM-DD'
    });

    $('.timepicker').each(function(){
        if ($(this).val() == '') {
            $(this).val($(this).data('default-time'));
        }
    });

    $('.typeahead').typeahead(
        { minLength: 1, highlight: true },
        { name: '_types', source: typeaheadMatcher(_types) });

});