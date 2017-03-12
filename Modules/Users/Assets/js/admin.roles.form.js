(function ($, W, D) {

    $(D).bind('CVEPDB_READY', function () {
        var input_display_name = $('input[name="display_name"]');
        var input_name = $('input[name="name"]');

        input_display_name.keyup(function(){
            input_name.val(cvepdb.string.slugify($(this).val()));
        });
    });

    $(D).bind('CVEPDB_TINYMCE_READY', function () {
        cvepdb.debug('admin.roles.form.js > CVEPDB_TINYMCE_READY : success : Start');
        cvepdb.editor.simple_editor('textarea#description');
        cvepdb.debug('admin.roles.form.js > CVEPDB_TINYMCE_READY : success : End');
    });

    $(D).bind('CVEPDB_TINYMCE_EDITOR_READY', function (e, params) {
        cvepdb.debug('admin.roles.form.js > CVEPDB_TINYMCE_EDITOR_READY : success : Start');
        cvepdb.debug('admin.roles.form.js > CVEPDB_TINYMCE_EDITOR_READY : success : editor ID : #' + params.editor.id);

        tinyMCE.DOM.setStyle(
            tinyMCE.DOM.get(params.editor.id + '_ifr'),
            'height',
            '150px'
        );

        $('#' + params.editor.id + '_ifr')
            .closest('div.mce-tinymce')
            .css('width', '100%');

        cvepdb.debug('admin.roles.form.js > CVEPDB_TINYMCE_EDITOR_READY : success : End');
    });

    $(D).bind('CVEPDB_TINYMCE_CHANGE', function (e, params) {
        cvepdb.debug('admin.roles.form.js > CVEPDB_TINYMCE_CHANGE : success : Start');
        cvepdb.debug('admin.roles.form.js > CVEPDB_TINYMCE_CHANGE : success : editor ID : #' + params.editor.id);

        $('#' + params.editor.id).text(params.content);

        cvepdb.debug('admin.roles.form.js > CVEPDB_TINYMCE_CHANGE : success : End');
    });


    $(D).bind('CVEPDB_FORM_VALIDATION_READY', function () {
        cvepdb.debug('admin.roles.form.js > CVEPDB_FORM_VALIDATION_READY : success : Start');

        cvepdb.fv.on_submit(function() {
            return true;
        });

        cvepdb.fv.set_rules('form.forms', {
            ignore: [':textarea:hidden.not(".js-call-tinymce")'],
            rules: {
                name: {
                    required: true,
                    maxlength: 254
                },
                display_name: {
                    required: true,
                    maxlength: 254
                },
                description: {
                    required: true,
                    maxlength: 254
                }
            },
            messages: {
                name: {
                    required: cvepdb.globalize.translate('FIELD_REQUIRED'),
                    maxlength: cvepdb.globalize.translate('FIELD_MAXLENGTH').replace('%text%', '{0}')
                },
                display_name: {
                    required: cvepdb.globalize.translate('FIELD_REQUIRED'),
                    maxlength: cvepdb.globalize.translate('FIELD_MAXLENGTH').replace('%text%', '{0}')
                },
                description: {
                    required: cvepdb.globalize.translate('FIELD_REQUIRED'),
                    maxlength: cvepdb.globalize.translate('FIELD_MAXLENGTH').replace('%text%', '{0}')
                }
            },
            errorPlacement: function (error, element) {

                if ($(element).attr('type') != 'hidden') {
                    error.insertAfter(element);
                }

                var current_form_group = $(element).closest(".form-group");
                current_form_group.removeClass("has-success");
                current_form_group.addClass("has-error");
            },
            errorElement: "div",
            errorClass: 'required',
            highlight: function (element) { // <-- fires when element has error
                var current_form_group = $(element).closest(".form-group");
                current_form_group.removeClass("has-success");
                current_form_group.addClass("has-error");
            },
            unhighlight: function (element) { // <-- fires when element is valid
                var current_form_group = $(element).closest(".form-group");
                current_form_group.removeClass("has-error");
                current_form_group.addClass("has-success");
            },
            success: function (element) {
                var current_form_group = element.closest(".form-group");
                current_form_group.removeClass("has-error");
                current_form_group.addClass("has-success");
            }
        });
        cvepdb.debug('admin.roles.form.js > CVEPDB_FORM_VALIDATION_READY : success : End');
    });
})(jQuery, window, document);