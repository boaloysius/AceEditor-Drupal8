(function ($, Drupal) {
    'use strict';

    Drupal.behaviors.ace_formatter = {
        attach: function (context, settings) {
            console.log(settings.ace_formatter);
        }
    };

})(jQuery, Drupal);