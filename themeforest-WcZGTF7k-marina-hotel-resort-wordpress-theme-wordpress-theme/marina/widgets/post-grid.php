<?php

class marina_Post_Grid_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'marina_post_grid';
    }

    public function get_title() {
        return esc_html__( 'marina Post Grid', 'marina' );
    }

    public function get_icon() {
        return 'eicon-post-list';
    }

    public function get_categories() {
        return [ 'basic' ];
    }

    public function get_keywords() {
        return [ 'marina', 'post' ];
    }

    protected function render() {
        
        $nicdark_result = '';

        //default values for wp query
        $nicdark_postgrid_qnt = 3;
        $nicdark_postgrid_order = 'DESC';
        $nicdark_postgrid_orderby = 'date';
        $nicdark_postgrid_image_size = 'large';

        //args
        $nicdark_args = array(
            'post_type' => 'post',
            'posts_per_page' => $nicdark_postgrid_qnt,
            'order' => $nicdark_postgrid_order,
            'orderby' => $nicdark_postgrid_orderby
        );
        $nicdark_the_query = new WP_Query( $nicdark_args );




        $nicdark_result .= '<div class="nicdark_section nicdark_marina_post_grid">';

        while ( $nicdark_the_query->have_posts() ) : $nicdark_the_query->the_post();

            //info
            $nicdark_id        = get_the_ID();
            $nicdark_title     = get_the_title();
            $nicdark_excerpt   = wp_kses_post( get_the_excerpt() );
            $nicdark_permalink = get_permalink( $nicdark_id );

            //image
            $nicdark_image_id   = get_post_thumbnail_id( $nicdark_id );
            $nicdark_image_html = '';

            if ( $nicdark_image_id ) {
                $nicdark_image_alt   = get_post_meta( $nicdark_image_id, '_wp_attachment_image_alt', true );
                $nicdark_image_alt   = $nicdark_image_alt ? $nicdark_image_alt : $nicdark_title;
                $nicdark_image_html  = wp_get_attachment_image(
                    $nicdark_image_id,
                    $nicdark_postgrid_image_size,
                    false,
                    array(
                        'class'    => 'nicdark_post_grid_image',
                        'loading'  => 'lazy',
                        'decoding' => 'async',
                        'alt'      => esc_attr( $nicdark_image_alt ),
                    )
                );

                if ( $nicdark_image_html ) {
                    $nicdark_image_html = '<a href="' . esc_url( $nicdark_permalink ) . '">' . $nicdark_image_html . '</a>';
                }
            }

            /*START HTML output*/
            $nicdark_result .= '

            <div class="nicdark_section nicdark_marina_post_grid nicdark_grid_4">

                ' . $nicdark_image_html . '
                <div class="nd_elements_section nd_elements_height_20"></div>
                <a href="' . esc_url( $nicdark_permalink ) . '"><h3>' . esc_html( $nicdark_title ) . '</h3></a>
                <div class="nd_elements_section nd_elements_height_20"></div>
                <p>' . $nicdark_excerpt . '</p>
                <div class="nd_elements_section nd_elements_height_20"></div>
                <a class="nicdark_marina_post_grid_button nicdark_display_inline_block nicdark_font_size_16 nicdark_text_align_center nicdark_letter_spacing_1 nicdark_box_sizing_border_box nicdark_border_1_dashed_color nicdark_padding_15_30 nicdark_padding_top_13 nicdark_color_greydark_important nicdark_font_weight_400 nicdark_bg_orange " href="' . esc_url( $nicdark_permalink ) . '">' . esc_html__( 'Read More', 'marina' ) . '</a>

            </div>

            ';
            /*END HTML output*/


        endwhile;

        $nicdark_result .= '</div>';



        wp_reset_postdata();


        echo $nicdark_result;


    }

}
