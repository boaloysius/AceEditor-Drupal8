(function ($, Drupal) {
    'use strict';

    var editors = {};
    /**
     * @file
     * Defines AceEditor as a Drupal editor.
     */

    /**
     * Define editor methods.
     */
    if (Drupal.editors) Drupal.editors.ace_editor = {
        attach: function (element, format) {
            
            element = $(element);
            var element_id = element.attr("id");
            var ace_editor_id = element_id+"-ace-editor";

            var editor_dummy = "<pre id='"+ace_editor_id+"'></pre>";

            element.hide();

            $(element).closest(".form-textarea-wrapper").append(editor_dummy);
            editors[ace_editor_id] = ace.edit(ace_editor_id);

            var theme = format.editorSettings["theme"];
            var mode = format.editorSettings["syntax"];

            editors[ace_editor_id].setTheme("ace/theme/"+theme);
            editors[ace_editor_id].getSession().setMode("ace/mode/"+mode);

            editors[ace_editor_id].getSession().setValue(element.val());

            editors[ace_editor_id].getSession().on('change', function () {
                element.val(editors[ace_editor_id].getSession().getValue());
            });

            //editor.setTheme()
            
            
        },
        detach: function (element, format, trigger) {

            element = $(element);
            var element_id = element.attr("id");
            var ace_editor_id = element_id+"-ace-editor";

            element.show();

            editors[ace_editor_id].destroy();
            editors[ace_editor_id].container.remove();
        },
        onChange: function (element, callback) {

        }
    };

})(jQuery, Drupal);
