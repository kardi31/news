(function () {
    kardiCroppic = function (element, options) {
        var that = this;

        var $image = $(element.find('.originalPhoto')[0]);
        var $button = $(element.find('.cropIt')[0]);
        var $result = $(element.find('.photoPreview')[0]);
        var $modalButton = $(element.find('.modalShow')[0]);
        var $modalWrapper = $(element.find('.modal')[0]);
        var croppable = false;

        var size = options.size;
        var outputFilename = options.outputFilename;
        var sizeExpl = size.split('x');
        var width = sizeExpl[0];
        var height = sizeExpl[1];

        $modalButton.on('click', function () {
            $modalWrapper.modal('show');

            $modalWrapper.on('shown.bs.modal', function () {
                console.log(width);
                console.log(height);
                $image.cropper({
                    autoCropArea: 0,
                    aspectRatio: width/height,
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
                data: {photo: photoData, filename: outputFilename},
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
