$(function () {
    // CKE Editor
    $.each($('textarea.ckeditor-custom'), function (key, value) {
        window.CKEDITOR.replace(value.id, {
            toolbar: [
                {
                    name: 'clipboard',
                    groups: ['clipboard', 'undo'],
                    items: ['Cut', 'Copy', 'Paste', '-', 'Undo', 'Redo']
                },
                {
                    name: 'paragraph',
                    groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
                    items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl']
                },
                {
                    name: 'basicstyles',
                    groups: ['basicstyles', 'cleanup'],
                    items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat']
                },
                {name: 'links', items: ['Link', 'Unlink']},
                {name: 'styles', items: ['Format', 'Font', 'FontSize']},
                {name: 'colors', items: ['TextColor', 'BGColor']}
            ],
            uiColor: '#9AB8F3'
        });
    });

    // Datetime picker
    $(".datetimepicker-custom").datetimepicker({
        autoclose: true,
        isRTL: false,
        format: "dd/mm/yyyy hh:ii",
        fontAwesome: true,
        pickerPosition: "bottom-left"
    });

    // select2
    $('.select2, .select2-multiple').select2();
})
