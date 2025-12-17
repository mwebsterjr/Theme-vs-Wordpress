<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
 
    <meta charset="<?php bloginfo('charset'); ?>"> 
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        	
<?php wp_head(); ?>	  
</head>  

<body id="start_nicdark_framework" <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="nicdark-skip-link" href="#nicdark-content"><?php esc_html_e( 'Skip to content', 'marina' ); ?></a>

<!--START theme-->
<div id="nicdark-content" class="nicdark_site nicdark_bg_white <?php if ( is_front_page() ) { echo esc_html("nicdark_front_page"); } ?> ">
	
<?php if( get_option('nicdark_type_demo') == 1 ){}else{ ?>

<!--START section-->
<div class="nicdark_section nicdark_bg_orange nicdark_custom_bg">

    <!--start container-->
    <div class="nicdark_clearfix">
        
        
        <!--START LOGO OR TAGLINE-->
        <?php
            
            $nicdark_customizer_logo_img = get_option( 'site_logo' );
            if ( $nicdark_customizer_logo_img == '' or $nicdark_customizer_logo_img == 0 ) { ?>
                
            <div class="nicdark_grid_2 nicdark_logo_section nicdark_padding_0 nicdark_padding_bottom_0_responsive nicdark_text_align_center_responsive nicdark_text_align_left">
                <a href="<?php echo esc_url(home_url()); ?>"><h3 class="nicdark_blog_info_name nicdark_color_greydark nicdark_font_size_25 nicdark_font_weight_bolder nicdark_letter_spacing_2 "><?php echo esc_html(get_bloginfo( 'name' )); ?></h3></a>
            </div>

        <?php

            }else{ 

                $nicdark_customizer_logo_id  = absint( $nicdark_customizer_logo_img );
                $nicdark_customizer_logo_img = wp_get_attachment_image( $nicdark_customizer_logo_id, 'medium', false, array(
                    'class'    => 'nicdark_width_230',
                    'loading'  => 'eager',
                    'decoding' => 'async',
                    'alt'      => esc_attr( get_bloginfo( 'name' ) ),
                    'sizes'    => '(max-width: 600px) 180px, 230px',
                ) );

            ?>

            <div class="nicdark_grid_2 nicdark_logo_section nicdark_padding_0 nicdark_text_align_center_responsive nicdark_text_align_left">
                <a href="<?php echo esc_url(home_url()); ?>">
                    <?php echo wp_kses_post( $nicdark_customizer_logo_img ); ?>
                </a>
            </div>

        <?php } ?>
        <!--END LOGO OR TAGLINE-->



        <div class="nicdark_grid_8 nicdark_padding_0 nicdark_text_align_center_responsive">

            <nav class="nicdark_section nicdark_navigation_1" aria-label="<?php esc_attr_e( 'Primary menu', 'marina' ); ?>">
                <?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'fallback_cb' => '__return_empty_string' ) ); ?>
            </nav>

        </div>



        <?php 

        $nicdark_text_header_button = get_option( 'nicdark_text_header_button' );
        if ( $nicdark_text_header_button == '' ) { $nicdark_text_header_button = __('Call Us','marina'); }

        $nicdark_link_header_button = get_option( 'nicdark_link_header_button' );
        if ( $nicdark_link_header_button == '' ) { $nicdark_link_header_button = home_url(); }

        ?>



        <div class="nicdark_grid_2 nicdark_padding_0 nicdark_text_align_right nicdark_text_align_center_responsive">

            <!--open menu responsive icon-->
            <div class="nicdark_section nicdark_display_none nicdark_display_block_responsive">
                <button class="nicdark_open_navigation_1_sidebar_content" type="button" aria-expanded="false" aria-controls="nicdark-mobile-nav" aria-label="<?php esc_attr_e('Open mobile navigation','marina'); ?>">
                    <img alt="" role="presentation" aria-hidden="true" width="25" height="25" src="<?php echo esc_url(get_template_directory_uri()); ?>/img/icon-menu-grey.png">
                </button>
            </div>
            <!--open menu responsive icon-->


            <a id="nicdark_header_t_btn" class="nicdark_display_none_all_responsive nicdark_bg_btn_archive nicdark_display_inline_block nicdark_font_size_16 nicdark_text_align_right nicdark_letter_spacing_1 nicdark_box_sizing_border_box nicdark_border_1_dashed_color nicdark_padding_15_30 nicdark_padding_top_13 nicdark_color_greydark nicdark_font_weight_400 nicdark_bg_orange " href="<?php echo esc_url($nicdark_link_header_button) ?>"><?php echo esc_html($nicdark_text_header_button); ?></a>

        </div>





    </div>
    <!--end container-->

</div>
<!--END section-->


<!--START menu responsive-->
<div id="nicdark-mobile-nav" class="nicdark_padding_100_40 nicdark_padding_bottom_40 nicdark_bg_black nicdark_custom_menu_bg nicdark_navigation_1_sidebar_content nicdark_box_sizing_border_box nicdark_overflow_hidden nicdark_overflow_y_auto nicdark_transition_all_08_ease nicdark_height_100_percentage nicdark_position_fixed nicdark_width_300 nicdark_right_300_negative nicdark_z_index_999" aria-hidden="true" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'Mobile navigation', 'marina' ); ?>">

    <div class="nicdark_bg_orange nicdark_width_300 nicdark_position_fixed nicdark_top_0 nicdark_text_align_center nicdark_margin_left_negative_40 nicdark_padding_top_20 nicdark_padding_bottom_20 nicdark_border_1_dashed_color">

        <button class="nicdark_close_navigation_1_sidebar_content nicdark_cursor_pointer nicdark_right_20 nicdark_top_29 nicdark_position_absolute" type="button" aria-label="<?php esc_attr_e('Close mobile navigation','marina'); ?>">
            <img alt="" role="presentation" aria-hidden="true" width="10" height="10" src="<?php echo esc_url(get_template_directory_uri()); ?>/img/icon-close.png">
        </button>

        <!--START LOGO OR TAGLINE-->
        <?php
            
            $nicdark_customizer_logo_img = get_option( 'nicdark_customizer_logo_img' );
            if ( $nicdark_customizer_logo_img == '' or $nicdark_customizer_logo_img == 0 ) { ?>
                
            <a href="<?php echo esc_url(home_url()); ?>">
                <h3 class="nicdark_color_greydark nicdark_font_size_25 nicdark_font_weight_bolder nicdark_letter_spacing_2">
                    <?php echo esc_html(get_bloginfo( 'name' )); ?>
                </h3>
            </a>

        <?php

            }else{ 

                $nicdark_customizer_logo_id  = absint( $nicdark_customizer_logo_img );
                $nicdark_customizer_logo_img = wp_get_attachment_image( $nicdark_customizer_logo_id, 'medium', false, array(
                    'class'    => 'nicdark_section',
                    'loading'  => 'lazy',
                    'decoding' => 'async',
                    'alt'      => esc_attr( get_bloginfo( 'name' ) ),
                    'sizes'    => '(max-width: 600px) 200px, 260px',
                ) );

            ?>

            <a class="nicdark_padding_50 nicdark_float_left nicdark_width_100_percentage nicdark_box_sizing_border_box nicdark_padding_top_0 nicdark_padding_botttom_0" href="<?php echo esc_url(home_url()); ?>">
                <?php echo wp_kses_post( $nicdark_customizer_logo_img ); ?>
            </a>

        <?php } ?>
        <!--END LOGO OR TAGLINE-->

        
    </div>


    <nav class="nicdark_navigation_1_sidebar" tabindex="-1" aria-label="<?php esc_attr_e( 'Primary', 'marina' ); ?>">
        <?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'fallback_cb' => '__return_empty_string' ) ); ?>
    </nav>



    <div class="nicdark-mobile-nav-overlay" aria-hidden="true"></div>

</div>
<!--END menu responsive-->

<?php } ?>
