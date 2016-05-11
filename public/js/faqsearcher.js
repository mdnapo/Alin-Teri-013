var $questions = $('.searchable');
var $categories = $('.category');

$('#search').keyup(function() {
    var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();

    $questions.show().filter(function() {
        var text = $(this).find('.answer,.question').text().replace(/\s+/g, ' ').toLowerCase();
        return !~text.indexOf(val);
    }).hide();

    $categories.show().filter(function(){
        if($(this).find('.panel').children(':visible').length > 0){
            return false;
        } else{
            return true;
        }
    }).hide();
});