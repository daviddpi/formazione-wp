<?php
/**
 * Function.php
 *
 * @package mytheme
 */

// Variables.

// Includes.


require get_theme_file_path( '/includes/front/enqueue.php' );
require get_theme_file_path( '/includes/front/head.php' );
require get_theme_file_path( '/includes/setup.php' );

// Hooks.
add_action( 'wp_enqueue_scripts', 'u_enqueue' );
add_action( 'wp_head', 'u_head', 5 );
add_action( 'after_setup_theme', 'u_setup_theme' );
