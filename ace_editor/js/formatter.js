(function ($, Drupal) {
    'use strict';

    Drupal.behaviors.ace_formatter = {
        attach: function (context, settings) {
            var ace_format_containers = $(".ace_formatter");
            $.each(ace_format_containers,function(index,container){

                container = $(container);

                var display_id = 'ace_formatter_display_'+index;
                if(! container.children("#"+display_id).length){
                    container.append("<div id='" + display_id + "'></div>");
                }
                var content = container.children(".content:first");
                content.hide();

                var theme = settings.ace_formatter.theme;
                var mode = settings.ace_formatter.syntax;

                console.log(container.html());

                var editor = ace.edit(display_id);
                editor.setReadOnly(true);
                editor.setTheme("ace/theme/"+theme);
                editor.getSession().setMode("ace/mode/"+mode);
                editor.getSession().setValue(content.html());

            });
        }
    };

})(jQuery, Drupal);