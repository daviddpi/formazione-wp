<?php
/**
 * Plugin Name:      Udemy Plus Plugin
 * PHP version: 8.2
 * Description:      Plugin per la creazione di blocchi Gutenberg con js e jsx.
 * Version:          1.0.0
 * Requires at least: 6.5.2
 * Requires PHP:      8.2
 * Author:            The Wave Studio
 * Author URI:        https://www.thewavestudio.it/
 * Text Domain:      up
 *
 * @package up
 */

if ( ! function_exists( 'add_action' ) ) {
	echo 'Message';
	exit;
}


// Setup.
define( 'UP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

// Includes.
$rootFiles         = glob( UP_PLUGIN_DIR . 'includes/*.php' );
$subDirectoryFiles = glob( UP_PLUGIN_DIR . 'includes/**/*.php' );
$allFiles          = array_merge( $rootFiles, $subDirectoryFiles );

foreach ( $allFiles as $filename ) {
	include_once $filename;
}

// hooks.
register_activation_hook( __FILE__, 'up_activate_plugin' );
add_action( 'init', 'up_register_blocks' );
add_action( 'rest_api_init', 'up_rest_api_init' );
add_action( 'wp_enqueue_scripts', 'up_enqueue_scripts' );
add_action( 'init', 'up_recipe_post_type' );
add_action( 'cuisine_add_form_fields', 'up_cuisine_add_form_fields' );
add_action( 'create_cuisine', 'up_save_cuisine_meta' );
add_action( 'cuisine_edit_form_fields', 'up_cuisine_edit_form_fields' );
add_action( 'edited_cuisine', 'up_save_cuisine_meta' );
add_action( 'save_post_recipe', 'up_save_post_recipe' );
add_action( 'after_setup_theme', 'up_setup_theme' );
add_filter( 'image_size_names_choose', 'up_custom_image_size' );
