/**
 * Created by dodedodo33 on 10-5-16.
 */

function resize() {
    $('.answer').each(function(index) {
        $(this).outerHeight($('.faq:eq(' + index + ')').height() - $('.question:eq(' + index + ')').outerHeight());
    });
}

$(function () {
    resize();
    $(window).resize(resize);
});
