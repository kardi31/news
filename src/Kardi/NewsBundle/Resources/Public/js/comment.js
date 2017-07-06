$(function () {
    $('.reply-comment').on('click', function () {

        var that = $(this);
        var id = that.data('id');
        var targetElement = $('.writecomment[rel=' + id + ']');

        if (!targetElement.is(':visible')) {
            $('.writecomment').hide();
            $('#writecomment .writecomment').show();
            targetElement.slideDown();
        }
    });
});

