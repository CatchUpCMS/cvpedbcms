(function ($, W, D) {

    "use strict";

    var _cms = {};

    _cms.settings = {
        set: function(setting_key, setting_value, success, error, complete){
            var request = {
                type: "POST",
                url: cvepdb_config.url_site + '/v1/settings/set',
                data: {
                    "_method": "POST",
                    "setting_key": setting_key,
                    "setting_value": setting_value
                }
            };
            $.ajax(_cms.settings.add_ajax_callback(request, success, error, complete));
        },
        get: function(setting_key, success, error, complete){
            var request = {
                type: "POST",
                url: cvepdb_config.url_site + '/v1/settings/get',
                data: {
                    "_method": "POST",
                    "setting_key": setting_key
                }
            };
            $.ajax(_cms.settings.add_ajax_callback(request, success, error, complete));
        },
        add_ajax_callback: function(request, success, error, complete) {
            if ($.isFunction(success)) {
                request['success'] = success;
            }
            if ($.isFunction(error)) {
                request['error'] = error;
            }
            if ($.isFunction(complete)) {
                request['complete'] = complete;
            }
            return request;
        }
    };

    _cms.settings_panel = {

    };

})(jQuery, window, document);
