<?php

/**
 * Pagination
 *
 * @param string $num_pages
 * @param string $page_range
 * @param string $paged
 * @param string $query
 */
function pip_pagination( $num_pages = '', $page_range = '', $paged = '', $query = '' ) {

    // Set page_range if empty
    $page_range = $page_range ? $page_range : 2;

    // Set paged if empty
    global $paged;
    $paged = $paged ? $paged : 1;

    // Set num_pages
    global $wp_query;
    if ( $query ) {
        $wp_query = $query;
    }

    $num_pages = ( $num_pages ? $num_pages : $wp_query->max_num_pages ) ? $wp_query->max_num_pages : 1;

    // Get paginate links
    $pagination_numbers = paginate_links(
        array(
            'base'         => trailingslashit( get_pagenum_link( 1 ) ) . '%_%',
            'format'       => 'page/%#%',
            'total'        => $num_pages,
            'current'      => $paged,
            'show_all'     => false,
            'end_size'     => 1,
            'mid_size'     => $page_range,
            'prev_next'    => false,
            'type'         => 'plain',
            'add_args'     => false,
            'add_fragment' => '',
        )
    );

    // If no paginate links, return
    if ( !$pagination_numbers ) {
        return;
    }

    // Display pagination links
    ob_start(); ?>
    <div class="pagination relative flex items-center justify-center w-full">

        <?php // Previous page link ?>
        <?php if ( $paged > 1 ) : ?>
            <a
                    class="pagination-previous mr-auto hidden md:block"
                    href="<?php echo get_pagenum_link( $paged - 1 ); ?>">
                <span class="far fa-sm fa-arrow-left mr-1"></span>
                <?php _e( 'Page précédente', 'pilot-in' ); ?>
            </a>
        <?php endif; ?>

        <?php // Numbers ?>
        <div class="pagination-numbers absolute inset-auto">
            <?php echo $pagination_numbers; ?>
        </div>

        <?php // Next page link ?>
        <?php if ( $paged < $num_pages ) : ?>
            <a
                    class="pagination-next ml-auto hidden md:block"
                    href="<?php echo get_pagenum_link( $paged + 1 ); ?>">
                <?php _e( 'Page suivante', 'pilot-in' ); ?>
                <span class="far fa-sm fa-arrow-right ml-1"></span>
            </a>
        <?php endif; ?>

    </div>
    <?php
    echo ob_get_clean();
}

/**
 *  Retrieve layouts based on given "acf_fc_layout" in the pip_flexible of given post
 *
 * @param mixed  $layouts string or array of strings of the layouts' "acf_fc_layout"
 * @param string $post_id
 *
 * @return mixed false if no layouts were found, if found an array of layouts
 */
function pip_get_flexible_layout( $layouts, $post_id = '' ) {

    $response = false;

    if ( !$layouts ) {
        return $response;
    }

    $pip_flexible      = acf_get_instance( 'PIP_Flexible' );
    $pip_flexible_name = (string) $pip_flexible->flexible_field_name;
    $post_id           = $post_id ? $post_id : get_the_ID();
    $pip_flexible      = get_field( $pip_flexible_name, $post_id );

    if ( !$pip_flexible ) {
        return $response;
    }

    if ( !is_array( $layouts ) ) {
        $layouts = array( $layouts );
    }

    $found_layouts = array();
    foreach ( $pip_flexible as $position => $layout ) {
        $layout_name = pip_maybe_get( $layout, 'acf_fc_layout' );

        if ( in_array( $layout_name, $layouts, true ) ) {
            $found_layouts[ $position ] = pip_maybe_get( $pip_flexible, $position );
        }
    }

    if ( !empty( $found_layouts ) ) {
        $response = $found_layouts;
    }

    return $response;

}

/**
 *  Flatten a multidimensional array
 *
 * @param $array
 *
 * @return array|false
 */
function array_flatten_recursive( $array ) {

    if ( !$array ) {
        return false;
    }

    $flat = array();
    $rii  = new RecursiveIteratorIterator( new RecursiveArrayIterator( $array ) );

    foreach ( $rii as $value ) {
        $flat[] = $value;
    }

    return $flat;
}

/**
 *  PIP - Get Sized Image URL - Useful for getting sized URL in one line (most useful case with ACF Image)
 *
 * @param mixed  $img  image array or image ID
 * @param string $size image size
 *
 * @return string|null URL of the sized image
 *
 *  Example of use case : echo pip_get_sized_image_url( get_sub_field('img'), 'full' )
 */
function pip_get_sized_image_url( $img, $size = 'thumbnail' ) {
    if ( empty( $img ) ) {
        return null;
    }

    if ( is_array( $img ) ) {
        $img = pip_maybe_get( $img, 'ID' );
    }

    $attachment = wp_get_attachment_image_src( $img, $size );

    return reset( $attachment );
}

/**
 * Check if current language is RTL or LTR
 *
 * @return bool
 */
function pip_is_rtl() {
    if ( !function_exists( 'pll_current_language' ) ) {
        return false;
    }

    $current_language = pll_current_language( 'OBJECT' );

    return $current_language ? (bool) $current_language->is_rtl : false;
}

/**
 * Get layout configuration data
 *
 * @param string|null $layout_name
 *
 * @return array
 */
function pip_layout_configuration( $layout_name = null ) {

    // Get layout name
    $layout_object = (array) get_sub_field_object( 'layout_settings' );
    if ( pip_maybe_get( $layout_object, 'parent_layout' ) ) {
        $layout_name = pip_maybe_get( $layout_object, 'parent_layout' );
        $layout_name = $layout_name ? str_replace( 'layout_', '', $layout_name ) : '';
    }

    // Get layout vars
    $field_group = PIP_Layouts_Single::get_layout_field_group_by_slug( $layout_name );
    $layout_vars = acf_maybe_get( $field_group, 'pip_layout_var' );

    // Get configuration data
    $configuration  = (array) get_sub_field( 'layout_settings' );
    $bg_color       = pip_maybe_get( $configuration, 'bg_color' );
    $vertical_space = pip_maybe_get( $configuration, 'vertical_space' );
    $section_id_val = pip_maybe_get( $configuration, 'section_id' ) ? pip_maybe_get( $configuration, 'section_id' ) : acf_uniqid( $layout_name );
    $section_id     = $section_id_val ? 'id="' . $section_id_val . '"' : '';
    $section_class  = $layout_name . ' relative w-full ' . $bg_color . ' ' . $vertical_space;

    // Return layout configuration data
    return array(
        'layout_name'    => $layout_name,
        'section_class'  => $section_class,
        'section_id'     => $section_id,
        'bg_color'       => $bg_color,
        'vertical_space' => $vertical_space,
        'layout_vars'    => $layout_vars,
    );
}

if ( !function_exists( 'get_layout_title' ) ) {
    /**
     *  This function will return a string representation of the current layout title within a 'have_rows' loop
     *
     * @return string
     */
    function get_layout_title() {
        $layout_title = false;

        // Get row
        $row = get_row();
        if ( !$row ) {
            return $layout_title;
        }

        // Browse row
        foreach ( $row as $key => $value ) {
            // If no title, skip
            if ( mb_stripos( $key, '_title' ) === false ) {
                continue;
            }

            // Store value
            $layout_title = $value;
        }

        // Return title
        return $layout_title;

    }
}
