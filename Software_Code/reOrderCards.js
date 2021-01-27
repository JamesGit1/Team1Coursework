var fields = $('.fieldwrapper');
var count = 1;
$.each(fields, function() {
    $(this).attr('id','field' + count);
    count++;
});