<?php
/**
 * Active a plugin
 *
 * @package up
 */

/**
 * Active a plugin
 *
 * @return void
 */
function up_activate_plugin() {
	if ( version_compare( get_bloginfo( 'version' ), '5.9', '<' ) ) {
		wp_die( __( 'You must updated WordPress to use this plugin', 'up' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	up_recipe_post_type();
	flush_rewrite_rules();

	global $wpdb;
	$tableName      = "{$wpdb->prefix}recipe_ratings";
	$charsetCollate = $wpdb->get_charset_collate();

	$sql = "
		CREATE TABLE {$tableName} (
			ID bigint(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
			post_id bigint(20) unsigned NOT NULL, 
			user_id bigint(20) unsigned NOT NULL, 
			rating float(3,2) unsigned NOT NULL 
		) ENGINE='InnoDB' COLLATE {$charsetCollate};
	";

	require_once ABSPATH . '/wp-admin/includes/upgrade.php';
	dbDelta( $sql );
}
