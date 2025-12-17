<?php
/**
 * Theme setup and registration for menus, sidebars, block styles, and patterns.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function nicdark_theme_setup_features() {

    load_theme_textdomain( 'marina', get_template_directory() . '/languages' );

    register_nav_menus(
        array(
            'main-menu' => esc_html__( 'Main Menu', 'marina' ),
        )
    );

    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'post-formats', array( 'quote', 'image', 'link', 'video', 'gallery', 'audio' ) );
    add_theme_support( 'title-tag' );
    add_theme_support( 'align-wide' );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'custom-background' );
    add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
    add_theme_support( 'custom-logo' );
    add_theme_support( 'custom-header' );
    add_theme_support( 'customize-selective-refresh-widgets' );
    add_theme_support( 'woocommerce' );

    add_editor_style( 'css/custom-editor-style.css' );
}
add_action( 'after_setup_theme', 'nicdark_theme_setup_features' );

/**
 * Align content width with theme.json layout values for consistent embeds/media rendering.
 */
function nicdark_set_content_width() {
    $content_width = 760; // Default matches theme.json layout.contentSize.

    if ( function_exists( 'wp_get_global_settings' ) ) {
        $global_settings = wp_get_global_settings();

        if ( ! empty( $global_settings['layout']['contentSize'] ) ) {
            $content_width = intval( $global_settings['layout']['contentSize'] );
        }
    }

    /**
     * Filters the content width in pixels.
     *
     * @param int $content_width Maximum allowed width.
     */
    $GLOBALS['content_width'] = apply_filters( 'nicdark_content_width', $content_width );
}
add_action( 'after_setup_theme', 'nicdark_set_content_width', 0 );

// Sidebar
function nicdark_add_sidebars() {

    // Sidebar Main
    register_sidebar(array(
        'name' =>  esc_html__('Sidebar','marina'),
        'id' => 'nicdark_sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));

}
add_action( 'widgets_init', 'nicdark_add_sidebars' );

//add style to quote
if ( function_exists( 'register_block_style' ) ) {
    register_block_style(
        'core/quote',
        array(
            'name'         => 'blue-quote',
            'label'        => __( 'Blue Quote', 'marina' ),
            'is_default'   => true,
            'inline_style' => '.wp-block-quote.is-style-blue-quote { color: blue; }',
        )
    );
}

//add block pattern
function nicdark_register_block_patterns() {
        register_block_pattern(
            'wpdocs/nd-pattern',
            array(
                'title'         => __( 'ND Pattern', 'marina' ),
                'description'   => _x( 'Awesome ND Pattern', 'Use this nicdark pattern', 'marina' ),
                'content'       => '<!-- wp:paragraph --><p>Nicdark Pattern</p><!-- /wp:paragraph -->',
                'categories'    => array( 'text' ),
                'keywords'      => array( 'nicdark' ),
                'viewportWidth' => 800,
            )
        );
}
add_action( 'init', 'nicdark_register_block_patterns' );

//define nicdark theme option
function nicdark_theme_setup(){
    add_option( 'nicdark_theme_author', 1, '', 'yes' );
    update_option( 'nicdark_theme_author', 1 );
}
add_action( 'after_setup_theme', 'nicdark_theme_setup' );

