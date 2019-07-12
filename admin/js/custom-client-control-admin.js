(function ($) {
    'use strict';

    /**
     * All of the code for your admin-facing JavaScript source
     * should reside in this file.
     *
     * Note: It has been assumed you will write jQuery code here, so the
     * $ function reference has been prepared for usage within the scope
     * of this function.
     *
     * This enables you to define handlers, for when the DOM is ready:
     *
     * $(function() {
     *
     * });
     *
     * When the window is loaded:
     *
     * $( window ).load(function() {
     *
     * });
     *
     * ...and/or other possibilities.
     *
     * Ideally, it is not considered best practise to attach more than a
     * single DOM-ready or window-load handler for a particular page.
     * Although scripts in the WordPress core, Plugins and Themes may be
     * practising this, we should strive to set a better example in our own work.
     */

    jQuery(document).ready(function () {

        jQuery('#button_cloner').on('click touchstart', function (e) {
            e.preventDefault();
            jQuery('.element-container').append('<div class="element-item"><input type="text" name="ccc_elementos[]" class="widefat" value="" placeholder="Agregue aqui el elemento" /></div>');
        });

        jQuery('#button_cloner_offers').on('click touchstart', function (e) {
            e.preventDefault();
            jQuery('.offerings-container').append('<div class="element-item"><input type="text" name="ccc_offers[]" class="widefat" value="" placeholder="Agregue aqui el elemento" /></div>');
        });

        jQuery('#print_budget').on('click touchstart', function (e) {
            e.preventDefault();
            jQuery.ajax({
                type: 'POST',
                url: admin_url.ajax_url,
                data: {
                    action: 'print_custom_budget',
                    post_id: jQuery('input[name=post_hidden_ID').val()
                },
                success: function (response) {
                    jQuery('.wp-admin').append(response);
                    window.print();
                    return false; // why false?
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                    console.log(jqXHR);
                    console.log(textStatus);
                }
            });
        });

    });

})(jQuery);
