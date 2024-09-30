<?php
/**
 * Recipe save meta fields
 *
 * @package up
 */

/**
 * Recipe save meta fields
 *
 * @param int $postId Post id.
 * @return void
 */
function up_save_post_recipe( int $postId ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	$rating = get_post_meta( $postId, 'recipe_ratings', true );
	$rating = empty( $rating ) ? 0 : float( $rating );
	update_post_meta( $postId, 'recipe_ratings', $rating );
}
