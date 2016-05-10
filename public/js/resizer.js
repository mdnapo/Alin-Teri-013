/**
 * Created by dodedodo33 on 10-5-16.
 */

function resize() {
    $('.answer').height($('.faq').height() - ($('.question').height() + 65));
}

$(function(){
    resize();
    $(window).resize(resize);
});
