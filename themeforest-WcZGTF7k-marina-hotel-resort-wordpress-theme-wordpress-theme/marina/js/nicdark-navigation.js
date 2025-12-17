/*
	Author: nicdark
	Author URI: http://www.nicdark.com/
*/

(function($) {
        "use strict";

        var $navigationToggle = $('.nicdark_open_navigation_1_sidebar_content');
        var $navigationPanel = $('.nicdark_navigation_1_sidebar_content');
        var $navigationClose = $('.nicdark_close_navigation_1_sidebar_content');
        var $navigationOverlay = $('.nicdark-mobile-nav-overlay');

        var focusableSelector = 'a[href], button:not([disabled]), textarea, input, select, [tabindex]:not([tabindex="-1"])';
        var lastFocusedToggle = null;

        if ( ! $navigationToggle.length || ! $navigationPanel.length ) {
                return;
        }

        function nicdarkOpenNavigation(event) {
                if ( event ) {
                        event.preventDefault();
                        lastFocusedToggle = event.currentTarget;
                } else {
                        lastFocusedToggle = document.activeElement;
                }
                $navigationPanel.addClass('is-open');
                $('body').addClass('nicdark_nav_open');
                $navigationOverlay.addClass('is-visible');
                $navigationToggle.attr('aria-expanded', 'true');
                $navigationPanel.attr('aria-hidden', 'false');
                $navigationOverlay.attr('aria-hidden', 'false');
                var focusable = $navigationPanel.find(focusableSelector).filter(':visible');
                if ( focusable.length ) {
                        focusable.first().focus();
                }
        }

        function nicdarkCloseNavigation(event) {
                if ( event ) {
                        event.preventDefault();
                }
                $navigationPanel.removeClass('is-open');
                $('body').removeClass('nicdark_nav_open');
                $navigationOverlay.removeClass('is-visible');
                $navigationToggle.attr('aria-expanded', 'false');
                $navigationPanel.attr('aria-hidden', 'true');
                $navigationOverlay.attr('aria-hidden', 'true');
                if ( lastFocusedToggle ) {
                        $( lastFocusedToggle ).focus();
                } else {
                        $navigationToggle.focus();
                }
        }

        $navigationToggle.on('click', nicdarkOpenNavigation);
        $navigationClose.on('click', nicdarkCloseNavigation);

        $(document).on('keyup', function(event) {
                if ( event.key === 'Escape' ) {
                        nicdarkCloseNavigation();
                }
        });

        $navigationOverlay.on('click', nicdarkCloseNavigation);

        $(document).on('keydown', function(event) {
                if ( event.key !== 'Tab' || ! $navigationPanel.hasClass('is-open') ) {
                        return;
                }

                var focusable = $navigationPanel.find(focusableSelector).filter(':visible');
                if ( ! focusable.length ) {
                        return;
                }

                var first = focusable.first()[0];
                var last = focusable.last()[0];

                if ( event.shiftKey && document.activeElement === first ) {
                        event.preventDefault();
                        last.focus();
                } else if ( ! event.shiftKey && document.activeElement === last ) {
                        event.preventDefault();
                        first.focus();
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
        var lastTrigger = null;

        var focusableSelector = 'a[href], button:not([disabled]), textarea, input, select, [tabindex]:not([tabindex="-1"])';
        var lastFocusedToggle = null;

        if ( ! $navigationToggle.length || ! $navigationPanel.length ) {
                return;
        }

        function setAriaHidden(isHidden) {
                $navigationPanel.attr('aria-hidden', isHidden ? 'true' : 'false');
                $navigationOverlay.attr('aria-hidden', isHidden ? 'true' : 'false');
        }

        function setAriaExpanded(isExpanded) {
                var value = isExpanded ? 'true' : 'false';
                $navigationToggle.attr('aria-expanded', value);
                $navigationClose.attr('aria-expanded', value);
        }

        function nicdarkOpenNavigation(event) {
                if ( event ) {
                        event.preventDefault();
                        lastFocusedToggle = event.currentTarget;
                } else {
                        lastFocusedToggle = document.activeElement;
                        lastTrigger = $(event.currentTarget);
                }
                if ( ! lastTrigger || ! lastTrigger.length ) {
                        lastTrigger = $navigationToggle.first();
                }
                $navigationPanel.addClass('is-open');
                $('body').addClass('nicdark_nav_open');
                $navigationOverlay.addClass('is-visible');
                setAriaExpanded(true);
                setAriaHidden(false);

                var focusable = $navigationPanel.find(focusableSelector).filter(':visible');
                if ( focusable.length ) {
                        focusable.first().focus();
                } else {
                        $navigationPanel.attr('tabindex', '-1').focus();
                }
        }

        function nicdarkCloseNavigation(event) {
                if ( event ) {
                        event.preventDefault();
                }
                $navigationPanel.removeClass('is-open');
                $('body').removeClass('nicdark_nav_open');
                $navigationOverlay.removeClass('is-visible');
                $navigationToggle.attr('aria-expanded', 'false');
                $navigationPanel.attr('aria-hidden', 'true');
                $navigationOverlay.attr('aria-hidden', 'true');
                if ( lastFocusedToggle ) {
                        $( lastFocusedToggle ).focus();
                } else {
                        $navigationToggle.focus();
                setAriaExpanded(false);
                setAriaHidden(true);
                if ( lastTrigger && lastTrigger.length ) {
                        lastTrigger.focus();
                } else {
                        $navigationToggle.first().focus();
                }
        }

        setAriaExpanded($navigationPanel.hasClass('is-open'));
        setAriaHidden(! $navigationPanel.hasClass('is-open'));

        $navigationToggle.on('click', nicdarkOpenNavigation);
        $navigationClose.on('click', nicdarkCloseNavigation);

        $(document).on('keyup', function(event) {
                if ( event.key === 'Escape' && $navigationPanel.hasClass('is-open') ) {
                        nicdarkCloseNavigation();
                }
        });

        $navigationOverlay.on('click', nicdarkCloseNavigation);

        $(document).on('keydown', function(event) {
                if ( event.key !== 'Tab' || ! $navigationPanel.hasClass('is-open') ) {
                        return;
                }

                var focusable = $navigationPanel.find(focusableSelector).filter(':visible');
                if ( ! focusable.length && $navigationPanel.is(':visible') ) {
                        focusable = $navigationPanel;
                }
                if ( ! focusable.length ) {
                        return;
                }

                var first = focusable.first()[0];
                var last = focusable.last()[0];

                if ( event.shiftKey && document.activeElement === first ) {
                        event.preventDefault();
                        last.focus();
                } else if ( ! event.shiftKey && document.activeElement === last ) {
                        event.preventDefault();
                        first.focus();
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
