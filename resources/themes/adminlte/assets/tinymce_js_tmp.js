/*
 * Main library for CVEPDB TinyMCE
 *
 * @emit CVEPDB_TINYMCE_READY event to specify cvepdb TinyMCE ready to go
 */
(function($, W, D){

    function elFinderBrowser(field_name, url, type, win) {
        tinymce.activeEditor.windowManager.open({
            file: '/admin/files/tinymce4',// use an absolute path!
            title: 'Files',
            width: 900,
            height: 450,
            resizable: 'yes'
        }, {
            setUrl: function (url) {
                win.document.getElementById(field_name).value = url;
            }
        });
        return false;
    }

    _cvepdb_tinymce = {
        class_to_call: '.js-call-tinymce',
        default_element: 'textarea.js-call-tinymce',
        default_theme: 'ribbon',
        default_height: 350,
        //default_plugins: [],
        //default_toolbar: 'undo redo | bold italic | bullist numlist | link image',
        // Barre de status en bas de l'editeur, indique dans quels balises ont se trouve.
        //default_statusbar: false,
        // Barre du haut comme sur un logiciel window (fichier, etc..)
        //default_menubar: false,
        //default_style_formats: []
    };


    _cvepdb_tinymce.libraries = [
        {
            script: {
                CVEPDB_TINYMCE_START: (cvepdb.config.url_theme + cvepdb.config.base_path + 'tinymce/tinymce.min.js')
            },
            trigger: 'always',
            mobile: true,
            browser: true
        }
    ];

    /**
     *  Load libraries
     */
    _cvepdb_tinymce.setup = function(){
        cvepdb.debug('cvepdb_tinymce.js > setup : success : Start');
        $.each(_cvepdb_tinymce.libraries, function(index, libjs){
            cvepdb.headjs.loadjs(libjs);
        });
        cvepdb.debug('cvepdb_tinymce.js > setup : success : End');
    };

    /**
     * Initialize default behaviour
     */
    _cvepdb_tinymce.start = function(){
        _cvepdb.debug('cvepdb_tinymce.js > _cvepdb_tinymce.start : success : Start');
        /**
         * For each tinymce elements
         *
         * @seealso http://www.tinymce.com/wiki.php/Configuration
         * @seealso http://www.tinymce.com/wiki.php/Configuration:statusbar
         * @seealso http://www.tinymce.com/wiki.php/Configuration:toolbar
         */
        $(_cvepdb_tinymce.default_element).each(function () {

            tinyMCE.baseURL = cvepdb.config.url_theme + cvepdb.config.base_path + 'tinymce';

            tinymce.init({
                selector: 'textarea#' + $(this).attr('id') + _cvepdb_tinymce.class_to_call,
                theme: _cvepdb_tinymce.default_theme,
                //height: _cvepdb_tinymce.default_height,
                //plugins: _cvepdb_tinymce.default_plugins,
                //toolbar: _cvepdb_tinymce.default_toolbar,
                //statusbar: _cvepdb_tinymce.default_statusbar,
                //menubar: _cvepdb_tinymce.default_menubar,
                //style_formats: _cvepdb_tinymce.default_style_formats,
                file_browser_callback: elFinderBrowser,

                height: 500,
                theme: 'modern',
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern '
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons',
                image_advtab: true,
                templates: [
                    { title: 'Test template 1', content: 'Test 1' },
                    { title: 'Test template 2', content: 'Test 2' }
                ],
                content_css: [],
                style_formats: [],


                setup: function (ed) {

                    /**
                     * @seealso http://www.tinymce.com/wiki.php/api4:class.tinymce.Editor
                     */
                    ed.on('NodeChange', function (e) {

                        cvepdb.debug('cvepdb_tinymce.js > _cvepdb_tinymce.start : success : l\'objet event ' + e);
                        cvepdb.debug('cvepdb_tinymce.js > _cvepdb_tinymce.start : success : l\'objet editeur ' + ed);
                        cvepdb.debug(
                            'cvepdb_tinymce.js > _cvepdb_tinymce.start : success : le contenu ' + ed.getContent()
                        );

                        $(D).trigger(
                            'CVEPDB_TINYMCE_CHANGE',
                            [{
                                event: e, // TinyMCE event
                                editor: ed, // TinyMCE editor
                                content: ed.getContent() // TinyMCE editor content
                            }]
                        );
                    });

                    /**
                     * Once TinyMCE ready
                     */
                    ed.on('init', function (e) {
                        $(D).trigger(
                            'CVEPDB_TINYMCE_EDITOR_READY',
                            [{
                                event: e, // TinyMCE event
                                editor: ed // TinyMCE editor
                            }]
                        );
                    });

                    /**
                     * When keyup happend in TinyMCE
                     */
                    ed.on('keyup', function (e) {
                        $(D).trigger(
                            'CVEPDB_TINYMCE_EDITOR_KEYUP',
                            [{
                                event: e,
                                editor: ed
                            }]
                        );
                    });

                }
            });
        });

        _cvepdb.debug('cvepdb_tinymce.js > _cvepdb_tinymce.start : success : End');
    };

    /**
     * CVEPDB TinyMCE library loaded
     */
    head.ready('CVEPDB_TINYMCE_LOADED', function(){
        cvepdb.debug('cvepdb_tinymce.js > cvepdb_tinymce_READY : success : Start');
        _cvepdb_tinymce.setup();
        cvepdb.debug('cvepdb_tinymce.js > cvepdb_tinymce_READY : success : End');
    });

    /**
     * CVEPDB TinyMCE library ready to start
     */
    head.ready('CVEPDB_TINYMCE_START', function(){
        cvepdb.debug('cvepdb_tinymce.js > CVEPDB_TINYMCE_READY : success : Start');
        _cvepdb_tinymce.start();
        $(D).trigger('CVEPDB_TINYMCE_READY');
        cvepdb.debug('cvepdb_tinymce.js > CVEPDB_TINYMCE_READY : success : End');
    });

})(jQuery, window, document);