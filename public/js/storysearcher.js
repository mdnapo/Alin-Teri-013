var $articles = $('.searchable');

$('#search').keyup(function() {
    var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();

    $articles.show().filter(function() {
        var text = $(this).find('.title,.text').text().replace(/\s+/g, ' ').toLowerCase();
        return !~text.indexOf(val);
    }).hide();
});