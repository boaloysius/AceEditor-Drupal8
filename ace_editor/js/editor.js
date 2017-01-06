(function ($, Drupal) {
    'use strict';
    // A page may contain multiple editors. editors variable store all of them as { id: editor_object }
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

            // Identifying the textarea as jQuery object.
            element = $(element);
            var element_id = element.attr("id");

            // Creating a unique id for our new text editor
            var ace_editor_id = element_id+"-ace-editor";

            // We don't delete the original textarea, but hide it.
            // We introduce a dummy dom element to make our editor and attach inside form textarea wrapper.
            var editor_dummy = "<pre id='"+ace_editor_id+"'></pre>";
            element.hide();
            $(element).closest(".form-textarea-wrapper").append(editor_dummy);

            // Creating new editor, setting syntax and theme.
            editors[ace_editor_id] = ace.edit(ace_editor_id);
            var theme = format.editorSettings["theme"];
            var mode = format.editorSettings["syntax"];
            editors[ace_editor_id].setTheme("ace/theme/"+theme);
            editors[ace_editor_id].getSession().setMode("ace/mode/"+mode);

            // Setting ace_editor styles.
            $("#"+ace_editor_id).height(format.editorSettings.height).width(format.editorSettings.width);
            editors[ace_editor_id].setOptions({
                fontSize: format.editorSettings.font_size
            });

            // On attaching our ace_editor, get value from textarea.
            editors[ace_editor_id].getSession().setValue(element.val());

            // On each change in ace_editor, change hidden textarea value.
            editors[ace_editor_id].getSession().on('change', function () {
                element.val(editors[ace_editor_id].getSession().getValue());
            });

            
        },
        detach: function (element, format, trigger) {

            // Identifying textarea as a jQuery object.
            element = $(element);
            var element_id = element.attr("id");
            var ace_editor_id = element_id+"-ace-editor";

            // Unhiding textare.
            element.show();

            // Destroting ace_editor.
            editors[ace_editor_id].destroy();
            editors[ace_editor_id].container.remove();
        },
        onChange: function (element, callback) {

        }
    };

})(jQuery, Drupal);
