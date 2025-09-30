<?php
/**
 * @package twentytwentyfive-child
 * @author openmindculture
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once( get_stylesheet_directory() . '/inc/functions/customize-frontend.php' );

add_action( 'wp_enqueue_scripts', function() {
	wp_enqueue_style( 'twentytwentyfive-child-style', get_stylesheet_uri() );
	wp_dequeue_style('twentytwentyfive-style');
	wp_dequeue_style('twentytwentyfive-block-style');
} );

if (is_admin()) {
	require_once( get_stylesheet_directory() . '/inc/functions/customize-backend.php' );
}