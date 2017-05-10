var refreshPhotoList = function (rootId) {
    $.ajax({
        url: Routing.generate('kardi_media_refresh_photo_list'),
        data: {
            'rootId': rootId
        },
        success: function (data) {
            $('#photo_admin_tab').html(data);
        },
        type: 'POST'
    });
};

var confirmPhotoRemoval = function () {
    $('.admin-image-buttons .delete').on('click', function () {
        if (!confirm('Czy na pewno chcesz usunąć to zdjęcie?')) {
            return false;
        }
    })
}

var moveImagePhoto = function(direction, id){
    $.ajax({
        url: Routing.generate('kardi_media_move_photo'),
        data: {
            direction: direction, id: id
        },
        success: function (data) {
            refreshPhotoList(data.rootId);
        },
        type: 'POST'
    });
}

var removeImagePhoto = function(id){
    console.log(id);
    $.ajax({
        url: Routing.generate('kardi_media_remove_photo'),
        data: {
            id: id
        },
        success: function (data) {
            refreshPhotoList(data.rootId);
        },
        type: 'POST'
    });
}

var EditImages = function () {

    var handleImages = function (bundle, entity, id) {

        // see http://www.plupload.com/
        var uploader = new plupload.Uploader({
            runtimes: 'html5,flash,silverlight,html4',

            browse_button: document.getElementById('tab_images_uploader_pickfiles'), // you can pass in id...
            container: document.getElementById('tab_images_uploader_container'), // ... or DOM Element itself

            url: "/admin/media/upload",

            filters: {
                max_file_size: '10mb',
                mime_types: [
                    {title: "Image files", extensions: "jpg,gif,png"},
                    {title: "Zip files", extensions: "zip"}
                ]
            },

            // Flash settings
            flash_swf_url: 'assets/plugins/plupload/js/Moxie.swf',

            // Silverlight settings
            silverlight_xap_url: 'assets/plugins/plupload/js/Moxie.xap',

            init: {
                PostInit: function () {
                    $('#tab_images_uploader_filelist').html("");

                    $('#tab_images_uploader_uploadfiles').click(function () {
                        uploader.start();
                        return false;
                    });

                    $('#tab_images_uploader_filelist').on('click', '.added-files .remove', function () {
                        uploader.removeFile($(this).parent('.added-files').attr("id"));
                        $(this).parent('.added-files').remove();
                    });
                },

                FilesAdded: function (up, files) {
                    plupload.each(files, function (file) {
                        $('#tab_images_uploader_filelist').append('<div class="alert alert-warning added-files" id="uploaded_file_' + file.id + '">' + file.name + '(' + plupload.formatSize(file.size) + ') <span class="status label label-info"></span>&nbsp;<a href="javascript:;" style="margin-top:-5px" class="remove pull-right btn btn-sm red"><i class="fa fa-times"></i> usuń</a></div>');
                    });
                },

                UploadProgress: function (up, file) {
                    $('#uploaded_file_' + file.id + ' > .status').html(file.percent + '%');
                },

                FileUploaded: function (up, file, response) {
                    var response = $.parseJSON(response.response);
                    // var url = Routing.generate('kardi_media_upload_photo');
                    if (response.result && response.result == 'OK') {
                        var filename = response.filename; // uploaded file's unique name. Here you can collect uploaded file names and submit an jax request to your server side script to process the uploaded files and update the images tabke
                        $.ajax({
                            url: Routing.generate('kardi_media_upload_photo'),
                            data: {
                                filename: filename, bundle: bundle, entity: entity, id: id
                            },
                            success: function (data) {
                                refreshPhotoList(data.rootId);
                                $('#uploaded_file_' + file.id + ' > .status').removeClass("label-info").addClass("label-success").html('<i class="fa fa-check"></i> Zdjęcie zostało załadowane'); // set successfull upload

                                App.alert({
                                    type: 'success',
                                    message: 'Zdjęcia zostały załadowane.',
                                    closeInSeconds: 10,
                                    icon: 'thumb-o'
                                });
                            },
                            error: function (data) {

                                $('#uploaded_file_' + file.id + ' > .status').removeClass("label-info").addClass("label-danger").html('<i class="fa fa-warning"></i> Wystąpił błąd'); // set failed upload
                                App.alert({
                                    type: 'danger',
                                    message: 'Zdjęcia nie zostały załadowane.',
                                    closeInSeconds: 10,
                                    icon: 'danger'
                                });
                            },
                            type: 'POST'
                        });

                    } else {
                        $('#uploaded_file_' + file.id + ' > .status').removeClass("label-info").addClass("label-danger").html('<i class="fa fa-warning"></i> Wystąpił błąd'); // set failed upload
                        App.alert({
                            type: 'danger',
                            message: 'Zdjęcia nie zostały załadowane.',
                            closeInSeconds: 10,
                            icon: 'warning'
                        });
                    }
                },

                Error: function (up, err) {
                    App.alert({type: 'danger', message: err.message, closeInSeconds: 10, icon: 'warning'});
                }
            }
        });

        uploader.init();

    }

    return {
        //main function to initiate the module
        init: function (bundle, entity, id) {
            handleImages(bundle, entity, id);
        }

    };
}();

$(function () {
    confirmPhotoRemoval();

    $('#photo_admin_tab').delegate('.admin-image-buttons .move-right','click',function(){
        moveImagePhoto('right',$(this).data('id'));
    });
    $('#photo_admin_tab').delegate('.admin-image-buttons .move-left','click',function(){
        moveImagePhoto('left',$(this).data('id'));
    });
    $('#photo_admin_tab').delegate('.admin-image-buttons .delete','click',function(){
        console.log($(this).data('id'));
        removeImagePhoto($(this).data('id'));
    });
});
