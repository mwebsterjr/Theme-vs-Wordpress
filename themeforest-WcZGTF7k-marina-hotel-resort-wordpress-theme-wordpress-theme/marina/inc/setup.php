<?php
/**
 * Theme setup helpers.
 */

/**
 * Sync the classic theme content width with theme.json layout settings.
 */
function nicdark_set_content_width() {
    $content_width = 760;
    $global_settings = function_exists( 'wp_get_global_settings' ) ? wp_get_global_settings() : array();

    if ( isset( $global_settings['layout']['contentSize'] ) && is_string( $global_settings['layout']['contentSize'] ) ) {
        // Keep content width in step with theme.json so classic templates and embeds mirror block previews.
        $parsed_width = floatval( $global_settings['layout']['contentSize'] );

        if ( $parsed_width > 0 ) {
            $content_width = $parsed_width;
        }
    }

    $GLOBALS['content_width'] = $content_width;
}
add_action( 'after_setup_theme', 'nicdark_set_content_width', 0 );
