<?php
/**
 * Cuisine save meta fields
 *
 * @package up
 */

/**
 * Cuisine save meta fields
 *
 * @param int $termID Term id.
 * @return void
 */
function up_save_cuisine_meta( int $termID ) {
	if ( ! isset( $_POST['up_more_info_url'] ) ) { // phpcs:ignore 
		return;
	}

	update_term_meta( $termID, 'more_info_url', sanitize_url(  $_POST['up_more_info_url'] )); //phpcs:ignore
}
