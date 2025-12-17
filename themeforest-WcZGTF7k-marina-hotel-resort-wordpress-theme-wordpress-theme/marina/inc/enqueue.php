<?php
/**
 * Asset loading for frontend and admin plus resource hints.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function nicdark_enqueue_scripts() {

    $nicdark_version = defined( 'NICDARK_THEME_VERSION' ) ? NICDARK_THEME_VERSION : false;

    //css
    wp_enqueue_style( 'nicdark-style', get_stylesheet_uri(), array(), $nicdark_version );

    $nicdark_google_font = nicdark_google_fonts_url();
    if ( $nicdark_google_font ) {
        wp_enqueue_style( 'nicdark-fonts', $nicdark_google_font, array(), $nicdark_version );
    }

    if ( post_type_exists( 'nd_booking_cpt_1' ) && ( is_singular( 'nd_booking_cpt_1' ) || is_post_type_archive( 'nd_booking_cpt_1' ) ) ) {
        wp_enqueue_style( 'nicdark-nd-booking-overrides', get_template_directory_uri() . '/css/nd-booking-overrides.css', array( 'nicdark-style' ), $nicdark_version );
    }

    //comment-reply
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    //navigation
    wp_enqueue_script( 'nicdark-navigation', get_template_directory_uri() . '/js/nicdark-navigation.js', array( 'jquery' ), $nicdark_version, true );

}
add_action( 'wp_enqueue_scripts', 'nicdark_enqueue_scripts' );

function nicdark_admin_enqueue_scripts() {

  wp_enqueue_style( 'nicdark-admin-style', get_template_directory_uri() . '/admin-style.css', array(), NICDARK_THEME_VERSION, false );

}
add_action( 'admin_enqueue_scripts', 'nicdark_admin_enqueue_scripts' );

//START add google fonts
function nicdark_google_fonts_url() {

    $nicdark_font_url = '';

    if ( 'off' !== _x( 'on', 'Google font: on or off', 'marina' ) ) {
        $nicdark_font_url = add_query_arg(
            array(
                'family' => urlencode( 'Jost:300,400,500,600,700|Italiana:400,500,600,700' ),
                'display' => 'swap',
            ),
            'https://fonts.googleapis.com/css'
        );
    }

    return $nicdark_font_url;

}
//END add google fonts

// Add preconnect hints for Google Fonts when used.
function nicdark_resource_hints( $urls, $relation_type ) {
    if ( 'preconnect' !== $relation_type ) {
        return $urls;
    }

    $fonts_enqueued = wp_style_is( 'nicdark-fonts', 'enqueued' );

    if ( $fonts_enqueued ) {
        $urls[] = array(
            'href'        => 'https://fonts.googleapis.com',
            'crossorigin' => true,
        );
        $urls[] = array(
            'href'        => 'https://fonts.gstatic.com',
            'crossorigin' => true,
        );
    }

    return $urls;
}
add_filter( 'wp_resource_hints', 'nicdark_resource_hints', 10, 2 );

