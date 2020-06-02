<?php

function alamanda_register_footer_widget_areas() {
    for ( $i = 1; $i <= 4; $i++ ) {
        register_sidebar( alamanda_widget_area_args( array(
            'name' => esc_html( sprintf( __( 'Footer %d', 'alamanda' ), $i ) )
        ) ) );
    }
}

add_action( 'widgets_init', 'alamanda_register_footer_widget_areas' );

function alamanda_site_footer_widgets() {
    if ( is_active_sidebar( 'footer-1' ) ) {
        echo '<div class="footer-widgets"><div class="wrap">';

        for ( $i = 1; $i <= 4; $i++ ) {
            dynamic_sidebar( 'footer-' . $i );
        }

        echo '</div></div>';
    }
}

add_action( 'tha_footer_before', 'alamanda_site_footer_widgets' );

function alamanda_site_footer() {
    $copyright_text = alamanda_get_copyright_text();
    
    echo '<div class="footer-container">';
    echo '<p class="copyright">', $copyright_text, '</p>';
    
    if ( has_nav_menu( 'footer' ) ) {
        wp_nav_menu( array( 'theme_location' => 'footer', 'menu_id' => '', 'menu_class' => 'footer-links', 'container' => '', 'depth' => 1 ) );
    }
    
    echo '</div>';
    echo '<a class="backtotop" href="#main-content">' . __( 'Back to top', 'alamanda' ) . alamanda_icon( array( 'icon' => 'arrow-up' ) ) . '</a>';
}

add_action( 'tha_footer_top', 'alamanda_site_footer' );

function alamanda_get_copyright_text() {
    $custom_copyright_text = get_theme_mod( 'alamanda_custom_copyright_text', '' );
    
    if ( '' === $custom_copyright_text ) {
        $custom_copyright_text = sprintf( __( 'Copyright &copy; %s %s. All Rights Reserved', 'alamanda' ), date( 'Y' ), get_bloginfo( 'name' ) );
    } else {
        $custom_copyright_text = str_replace( '{copyright}', sprintf( '&copy; %s', date( 'Y' ) ), $custom_copyright_text );
        $custom_copyright_text = str_replace( '{site_link}', sprintf( '<a href="%s">%s</a>', esc_url( home_url( '/' ) ), get_bloginfo( 'name', 'display' ) ), $custom_copyright_text );
    }
    
    return $custom_copyright_text;
}