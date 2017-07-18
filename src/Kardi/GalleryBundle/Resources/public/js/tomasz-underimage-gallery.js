$(function () {

    var mainPhoto = $('.the-image').find('img');

    // set main image from thumbs
    $('.photo-gallery-thumbs a.delegate').on('click', function () {
        var miniImage = $(this).find('img');
        var newImage = miniImage.data('src');
        mainPhoto.attr('src', newImage);
        return false;
    });

    $('.the-image .photo-controls').on('click', function () {
        var that = $(this);
        var currentMainPhotoSrc = mainPhoto.attr('src');
        var currentPhotoThumb = $('.photo-gallery-thumbs a.delegate').find('img[data-src="' + currentMainPhotoSrc + '"]');
        var parentA = currentPhotoThumb.parent();

        if (that.hasClass('right')) {
            parentA.next().click();
        }
        else {
            if (that.hasClass('left')) {
                parentA.prev().click();
            }
        }
        return false;
    });
});
