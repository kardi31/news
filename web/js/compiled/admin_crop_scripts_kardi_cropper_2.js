(function () {
    kardiCroppic = function (element, size) {
        var $image = $(element.find('.originalPhoto')[0]);
        var $button = $(element.find('.cropIt')[0]);
        var $result = $(element.find('.photoPreview')[0]);
        var $modalButton = $(element.find('.modalShow')[0]);
        var $modalWrapper = $(element.find('.modal')[0]);
        var croppable = false;

        var sizeExpl = size.split('x');
        var width = sizeExpl[0];
        var height = sizeExpl[1];

        $modalButton.on('click', function () {
            $modalWrapper.modal('show');

            $modalWrapper.on('shown.bs.modal', function () {
                $image.cropper({
                    aspectRatio: 1,
                    viewMode: 1,
                    scalable: false,
                    cropBoxResizable: false,
                    zoomable: false,
                    minCropBoxWidth: width,
                    minCropBoxHeight: height,
                    ready: function () {
                        croppable = true;
                    }
                });
            })
        });

        $button.on('click', function () {
            var croppedCanvas;

            if (!croppable) {
                return false;
            }

            // Crop
            croppedCanvas = $image.cropper('getCroppedCanvas', {width: width, height: height});

            // Show
            var photoData = croppedCanvas.toDataURL('image/jpeg');

            $.ajax(Routing.generate('kardi_media_crop_edited'), {
                method: "POST",
                data: {photo: photoData, filename: '{{ photo.show(size) }}'},
                success: function () {
                    $result.attr('src', photoData);
                    console.log('Upload success');
                },
                error: function () {
                    console.log('Upload error');
                }
            });
            $modalWrapper.modal('hide');
        });
    }
})(window, document);
