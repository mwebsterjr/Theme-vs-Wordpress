<?php

if ( ! defined( 'NICDARK_THEME_VERSION' ) ) {
    $nicdark_theme_object = wp_get_theme();
    define( 'NICDARK_THEME_VERSION', $nicdark_theme_object->get( 'Version' ) ? $nicdark_theme_object->get( 'Version' ) : '1.0.0' );
}


$nicdark_themename = "marina";

//TGMPA required plugin
require_once get_template_directory() . '/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'nicdark_register_required_plugins' );
function nicdark_register_required_plugins() {

    $nicdark_plugins = array(

        //wp import
        array(
            'name'      => esc_html__( 'Wordpress Importer', 'marina' ),
            'slug'      => 'wordpress-importer',
            'required'  => false,
        ),


        //nd shortcodes
        array(
            'name'      => esc_html__( 'ND Shortcodes', 'marina' ),
            'slug'      => 'nd-shortcodes',
            'required'  => true,
        ),


        //nd elements
        array(
            'name'      => esc_html__( 'ND Elements', 'marina' ),
            'slug'      => 'nd-elements',
            'required'  => true,
        ),


        //elementor
        array(
            'name'      => esc_html__( 'Elementor', 'marina' ),
            'slug'      => 'elementor',
            'required'  => true,
        ),

        //contact-form-7
        array(
            'name'      => esc_html__( 'Contact Form 7', 'marina' ),
            'slug'      => 'contact-form-7',
            'required'  => false,
        ),

        //woocommerce
        array(
            'name'      => esc_html__( 'WooCommerce', 'marina' ),
            'slug'      => 'woocommerce',
            'required'  => false,
        ),

        //motopress-hotel-booking-lite
        array(
            'name'      => esc_html__( 'Hotel Booking', 'marina' ),
            'slug'      => 'motopress-hotel-booking-lite',
            'required'  => false,
        ),

        //mphb-elementor
        array(
            'name'      => esc_html__( 'Hotel Booking - Elementor', 'marina' ),
            'slug'      => 'mphb-elementor',
            'required'  => false,
        ),
        

    );


    $nicdark_config = array(
        'id'           => 'marina',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table. 
    );

    tgmpa( $nicdark_plugins, $nicdark_config );
}
//END tgmpa

// Load modular theme setup to reduce functions.php size and improve maintainability.
require_once get_template_directory() . '/inc/setup.php';
require_once get_template_directory() . '/inc/enqueue.php';
require_once get_template_directory() . '/inc/elementor.php';



//START Add heaer customizer
add_action('customize_register','nicdark_customizer_header');
function nicdark_customizer_header( $wp_customize ) {
  

    //ADD panel
    $wp_customize->add_panel( 'nicdark_customizer_header_panel', array(
      'title' => __( 'Header marina','marina' ),
      'capability' => 'edit_theme_options',
      'theme_supports' => '',
      'description' => __( 'Header Settings','marina' ), //  html tags such as <p>.
      'priority' => 130, // Mixed with top-level-section hierarchy.
    ) );


    //ADD section
    $wp_customize->add_section( 'nicdark_customizer_header_section' , array(
      'title' => __( 'Button','marina' ),
      'priority'    => 50,
      'panel' => 'nicdark_customizer_header_panel',
    ) );


    //Option 1
    $wp_customize->add_setting( 'nicdark_text_header_button', array(
      'type' => 'option', // or 'option'
      'capability' => 'edit_theme_options',
      'theme_supports' => '', // Rarely needed.
      'default' => '',
      'transport' => 'refresh', // or postMessage
      'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'nicdark_text_header_button', array(
      'label' => __( 'Button Text','marina' ),
      'description' => __('Insert the Text for your header Button','marina'),
      'type' => 'text',
      'section' => 'nicdark_customizer_header_section',
    ) );


    //Option 2
    $wp_customize->add_setting( 'nicdark_link_header_button', array(
      'type' => 'option', // or 'option'
      'capability' => 'edit_theme_options',
      'theme_supports' => '', // Rarely needed.
      'default' => '',
      'transport' => 'refresh', // or postMessage
      'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( 'nicdark_link_header_button', array(
      'label' => __( 'Button Url','marina' ),
      'description' => __('Insert the Url for your header Button','marina'),
      'type' => 'url',
      'section' => 'nicdark_customizer_header_section',
    ) );




}





//START create welcome page on activation

//create transient
add_action( 'after_switch_theme','nicdark_welcome_set_trans');
function nicdark_welcome_set_trans(){ if ( ! is_network_admin() ) { set_transient( 'nicdark_welcome_page_redirect', 1, 30 ); } }

//create page
add_action('admin_menu', 'nicdark_create_welcome_page');
function nicdark_create_welcome_page() {
    add_menu_page(esc_html__( 'Marina Theme', 'marina' ), esc_html__( 'Marina Theme', 'marina' ), 'manage_options', 'nicdark-welcome-theme-page', 'nicdark_welcome_page_content', 'dashicons-admin-settings' );
}

//set redirect
add_action( 'admin_init', 'nicdark_welcome_theme_page_redirect' );
function nicdark_welcome_theme_page_redirect() {

    if ( ! get_transient( 'nicdark_welcome_page_redirect' ) ) { return; }
    delete_transient( 'nicdark_welcome_page_redirect' );
    if ( is_network_admin() ) { return; }
    wp_safe_redirect( add_query_arg( array( 'page' => 'nicdark-welcome-theme-page' ), esc_url( admin_url( 'admin.php' ) ) ) );
    exit;

}

//page content
function nicdark_welcome_page_content(){
    
    $nicdark_theme = wp_get_theme();

    //theme plugins required
    $nicdark_plugins_required = array('nd-shortcodes','nd-elements','wordpress-importer','elementor','contact-form-7','woocommerce');


    //start check if all plugins are activated
    $nicdark_all_plugins_required = 0;
    foreach( $nicdark_plugins_required as $nicdark_plugin_required ){

        if ($nicdark_plugin_required == 'nd-shortcodes') { $nicdark_plugin_required_function = 'nd_options_load_textdomain'; }
        if ($nicdark_plugin_required == 'nd-elements') { $nicdark_plugin_required_function = 'nd_elements_scripts'; }
        if ($nicdark_plugin_required == 'wordpress-importer') { $nicdark_plugin_required_function = 'wordpress_importer_init'; }
        if ($nicdark_plugin_required == 'elementor') { $nicdark_plugin_required_function = 'elementor_fail_wp_version'; }
        if ($nicdark_plugin_required == 'contact-form-7') { $nicdark_plugin_required_function = 'wpcf7_init'; }
        if ($nicdark_plugin_required == 'woocommerce') { $nicdark_plugin_required_function = 'wc_get_container'; }
        if ($nicdark_plugin_required == 'motopress-hotel-booking-lite') { $nicdark_plugin_required_function = 'mphb_get_template_part'; }
        if ($nicdark_plugin_required == 'mphb-elementor') { $nicdark_plugin_required_function = 'mphb_get_template_part'; }

        if ( function_exists($nicdark_plugin_required_function) ) {
            $nicdark_all_plugins_required = 1;
        }else{
            $nicdark_all_plugins_required = 0;
            break; 
        }

    }
    //end check if all plugins are activated


    ?>

    <style>
        #setting-error-tgmpa { display:none !important; }
    </style>

    <div class="nicdark_section nicdark_padding_right_20 nicdark_padding_left_2 nicdark_margin_top_25">

        

        <!--start THEME TITLE-->
        <div class="nicdark_section nicdark_background_color_1d2327 nicdark_padding_20 nicdark_border_bottom_3_solid_2271b1">
            <h2 class="nicdark_display_inline_block nicdark_color_ffffff">
                <?php esc_html_e('Marina','marina'); ?>   
            </h2>
            <span class="nicdark_color_a0a5aa nicdark_margin_left_10">
                <?php esc_html_e('3.0','marina'); ?>
            </span>
        </div>
        <!--end THEME TITLE-->

    


        <div class="nicdark_section nicdark_box_shadow_0_1_1_000_4 nicdark_background_color_ffffff nicdark_border_1_solid_e5e5e5 nicdark_border_1_solid_e5e5e5 nicdark_border_top_width_0 nicdark_border_left_width_0 nicdark_overflow_hidden nicdark_position_relative">
    
          


          <!--START menu-->
          <div class="nicdark_position_absolute nicdark_box_sizing_border_box nicdark_float_left nicdark_background_color_2c3338 nicdark_width_20_percentage nicdark_min_height_3000">

            <ul class="nicdark_demo_navigation nicdark_padding_0 nicdark_margin_0 nicdark_list_style_none">
              
                <li class="nicdark_padding_0 nicdark_margin_0">
                    <p class="nicdark_import_demo_nav nicdark_background_color_2271b1 nicdark_font_size_14px nicdark_text_decoration_none nicdark_color_ffffff nicdark_padding_8_20 nicdark_display_block nicdark_margin_0">
                        <?php esc_html_e('1 - Install Required Plugins','marina'); ?>        
                    </p>
                </li>
                
                <li class="nicdark_padding_0 nicdark_margin_0">
                    <p class="nicdark_import_demo_nav nicdark_font_size_14px nicdark_text_decoration_none nicdark_color_ffffff nicdark_padding_8_20 nicdark_display_block nicdark_margin_0">
                        <?php esc_html_e('2 - Choose the Demo','marina'); ?>        
                    </p>
                </li>

                <li class="nicdark_padding_0 nicdark_margin_0">
                    <p class="nicdark_import_demo_nav nicdark_font_size_14px nicdark_text_decoration_none nicdark_color_ffffff nicdark_padding_8_20 nicdark_display_block nicdark_margin_0">
                        <?php esc_html_e('3 - Import Content and Style','marina'); ?>
                    </p>
                </li>

                <li class="nicdark_padding_0 nicdark_margin_0">
                    <p class="nicdark_import_demo_nav nicdark_font_size_14px nicdark_text_decoration_none nicdark_color_ffffff nicdark_padding_8_20 nicdark_display_block nicdark_margin_0">
                        <?php esc_html_e('4 - Enjoy your Theme','marina'); ?>
                    </p>
                </li>


                <?php 

                if ( $nicdark_all_plugins_required == 1 ) {
                    if ( function_exists('nicdark_import_demo_nav') ){ do_action("nicdark_import_demo_nav_nd"); } 
                }

                ?>

                
            </ul>

          </div>
          <!--END menu-->





      <!--START content-->
      <div class="nicdark_padding_20 nicdark_box_sizing_border_box nicdark_margin_left_20_percentage nicdark_float_left nicdark_width_80_percentage">


        <!--START-->
        <div class="nicdark_section">
          
            

            <!--START 1-->
            <div class="nicdark_import_demo_1_step nicdark_padding_20 nicdark_box_sizing_border_box nicdark_width_100_percentage">


                <div class="nicdark_section">
                    <div class="nicdark_width_40_percentage nicdark_padding_20 nicdark_box_sizing_border_box nicdark_float_left">
                        <h1 class="nicdark_section nicdark_margin_0">
                            <?php esc_html_e('Marina Theme','marina'); ?>
                        </h1>
                        <p class="nicdark_color_666666 nicdark_section nicdark_margin_0 nicdark_margin_top_20">
                            <?php esc_html_e('Thanks for choosing our theme. If you want check also our site','marina'); ?>
                            <a target="_blank" href="https://www.nicdark.com"><?php esc_html_e('Nicdark.com','marina'); ?></a>
                        </p>
                    </div>
                </div>

                
                <div class="nicdark_section nicdark_height_1 nicdark_background_color_E7E7E7 nicdark_margin_top_10 nicdark_margin_bottom_10"></div>

                
                <div class="nicdark_section">
                    
                    <div class="nicdark_width_50_percentage nicdark_padding_20 nicdark_box_sizing_border_box nicdark_float_left">
                        <h2 class="nicdark_section nicdark_margin_0">
                            <?php esc_html_e('How do I import the sample demo ?','marina'); ?>
                        </h2>
                        <p class="nicdark_color_666666 nicdark_section nicdark_margin_0 nicdark_margin_top_10">
                            <?php esc_html_e('Start by installing and activating the plugins required by the theme','marina'); ?>
                        </p>
                        <a class="button button-primary nicdark_margin_top_15_important" target="_blank" href="<?php echo esc_url(admin_url('themes.php?page=tgmpa-install-plugins')); ?>">
                            <?php esc_html_e('Go to plugins page','marina'); ?>
                        </a>


                        <!--plugins notice-->
                        <div class="nicdark_box_sizing_border_box nicdark_float_left nicdark_width_100_percentage">
                          <div class="notice notice-error nicdark_padding_20 nicdark_margin_top_30 nicdark_margin_0">
                            <p><?php esc_html_e('If all the plugins are not installed and active it will not be possible to reach the second step, if you having trouble installing plugins check out our article below','marina'); ?></p>
                            <a target="blank" href="https://documentation.nicdark.com/plugin-installation-problems/"><?php esc_html_e('Check the article','marina'); ?></p></a>
                          </div>
                        </div>
                        <!--plugins notice-->


                    </div>


                    <div class="nicdark_width_50_percentage nicdark_padding_20 nicdark_text_align_center nicdark_box_sizing_border_box nicdark_float_left">
                        <img id="nicdark_theme_image" src="<?php  echo esc_url(get_template_directory_uri()); ?>/screenshot.jpg">
                        <a target="_blank" class="button" href="https://www.nicdark.com/wordpress-themes/"><?php esc_html_e('All Nicdark WordPress Themes','marina'); ?></a>
                    </div>


                </div>

                
                <div class="nicdark_section nicdark_height_1 nicdark_background_color_E7E7E7 nicdark_margin_top_10 nicdark_margin_bottom_10"></div>


                <div class="nicdark_section">
                    <div class="nicdark_width_50_percentage nicdark_padding_20 nicdark_box_sizing_border_box nicdark_float_left">
                        <p class="nicdark_color_666666 nicdark_section nicdark_margin_0 nicdark_margin_top_10">
                            <?php esc_html_e('Once all plugins are installed and activated, return and refresh this page for go the second step.','marina'); ?>
                        </p>
                    </div>
                </div>


          </div>
          <!--END 1-->


          <?php 


          if ( $nicdark_all_plugins_required == 1 ) {
            if ( function_exists('nicdark_import_demo') ){ do_action("nicdark_import_demo_nd"); } 
          }

          ?>


        </div>
        <!--END-->

      
      </div>
      <!--END content-->


    </div>

  </div>





<?php


}
//END create welcome page on activation
