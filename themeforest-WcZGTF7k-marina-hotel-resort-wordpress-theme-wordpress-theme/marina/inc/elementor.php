<?php
/**
 * Elementor widget bootstrap.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function nicdark_elementor_marina_post_grid_widget( $widgets_manager ) {

    require_once( __DIR__ . '/../widgets/post-grid.php' );
    $widgets_manager->register( new \marina_Post_Grid_Widget() );

}
add_action( 'elementor/widgets/register', 'nicdark_elementor_marina_post_grid_widget' );

