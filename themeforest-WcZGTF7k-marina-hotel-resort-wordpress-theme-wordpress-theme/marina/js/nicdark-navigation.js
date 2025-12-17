/*
	Author: nicdark
	Author URI: http://www.nicdark.com/
*/

(function($) {
        "use strict";

        var $navigationToggle = $('.nicdark_open_navigation_1_sidebar_content');
        var $navigationPanel = $('.nicdark_navigation_1_sidebar_content');
        var $navigationClose = $('.nicdark_close_navigation_1_sidebar_content');

        if ( ! $navigationToggle.length || ! $navigationPanel.length ) {
                return;
        }

        function nicdarkOpenNavigation(event) {
                if ( event ) {
                        event.preventDefault();
                }
                $navigationPanel.addClass('is-open');
                $('body').addClass('nicdark_nav_open');
                $navigationToggle.attr('aria-expanded', 'true');
                $navigationPanel.attr('aria-hidden', 'false');
        }

        function nicdarkCloseNavigation(event) {
                if ( event ) {
                        event.preventDefault();
                }
                $navigationPanel.removeClass('is-open');
                $('body').removeClass('nicdark_nav_open');
                $navigationToggle.attr('aria-expanded', 'false');
                $navigationPanel.attr('aria-hidden', 'true');
        }

        $navigationToggle.on('click', nicdarkOpenNavigation);
        $navigationClose.on('click', nicdarkCloseNavigation);

        $(document).on('keyup', function(event) {
                if ( event.key === 'Escape' ) {
                        nicdarkCloseNavigation();
                }
        });

        $(document).on('click', function(event) {
                if (
                        $navigationPanel.hasClass('is-open') &&
                        ! $navigationPanel.is(event.target) &&
                        $navigationPanel.has(event.target).length === 0 &&
                        ! $navigationToggle.is(event.target) &&
                        $navigationToggle.has(event.target).length === 0
                ) {
                        nicdarkCloseNavigation();
                }
        });

})(jQuery);