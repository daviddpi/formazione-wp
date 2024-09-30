<?php
/**
 * Render recipe summary
 *
 * @package up
 */

/**
 * Render function recipe summary
 *
 * @param array $atts Attribute.
 * @param mixed $content Content.
 * @param mixed $block Block.
 * @return string
 */
function up_recipe_summary_render_cb( array $atts, mixed $content, mixed $block ): string {

	$prepTime = isset( $atts['prepTime'] ) ? esc_html( ( $atts['prepTime'] ) ) : '';
	$cookTime = isset( $atts['cookTime'] ) ? esc_html( ( $atts['cookTime'] ) ) : '';
	$course   = isset( $atts['course'] ) ? esc_html( ( $atts['course'] ) ) : '';

	$postID    = $block->context['postId'];
	$postTerms = get_the_terms( $postID, 'cuisine' );
	$postTerms = is_array( $postTerms ) ? $postTerms : array();
	$cuisines  = '';
	$lastKey   = array_key_last( $postTerms );

	foreach ( $postTerms as $key => $term ) {
		$url       = get_term_meta( $term->term_id, 'more_info_url', true );
		$comma     = $key === $lastKey ? '' : ', ';
		$cuisines .= "<a href='{$url}' target='_blank'>{$term->name}</a>{$comma}";
	}

	$rating = get_post_meta( $postID, 'recipe_ratings', true );

	global $wpdb;
	$userID      = get_current_user_id();
	$ratingCount = $wpdb->get_var($wpdb->prepare( //phpcs:ignore
		"SELECT COUNT(*) FROM {$wpdb->prefix}recipe_ratings
		WHERE post_id=%d AND user_id=%d",
		$postID, $userID
	));

	ob_start();
	?>
		<div class="wp-block-udemy-plus-recipe-summary">
			<i class="bi bi-alarm"></i>
			<div class="recipe-columns-2">
				<div class="recipe-metadata">
				<div class="recipe-title">
					<?php _e( 'Prep Time', 'udemy-plus' ); //phpcs:ignore ?>
				</div>
				<div class="recipe-data recipe-prep-time">
					<?php echo $prepTime;  //phpcs:ignore?>
				</div>
				</div>
				<div class="recipe-metadata">
				<div class="recipe-title">
					<?php _e( 'Cook Time', 'udemy-plus' );  //phpcs:ignore?>
				</div>
				<div class="recipe-data recipe-cook-time">
					<?php echo $cookTime;  //phpcs:ignore?>
				</div>
				</div>
			</div>
			<div class="recipe-columns-2-alt">
				<div class="recipe-columns-2">
				<div class="recipe-metadata">
					<div class="recipe-title">
					<?php _e( 'Course', 'udemy-plus' );  //phpcs:ignore ?>
					</div>
					<div class="recipe-data recipe-course">
					<?php echo $course;  //phpcs:ignore ?>
					</div>
				</div>
				<div class="recipe-metadata">
					<div class="recipe-title">
					<?php _e( 'Cuisine', 'udemy-plus' );  //phpcs:ignore ?>
					</div>
					<div class="recipe-data recipe-cuisine">
					<?php echo $cuisines;  //phpcs:ignore ?>

					</div>
				</div>
				<i class="bi bi-egg-fried"></i>
				</div>
				<div class="recipe-metadata">
				<div class="recipe-title">
					<?php _e( 'Rating', 'udemy-plus' );  //phpcs:ignore ?>
				</div>
				<div id="recipe-rating" class="recipe-data" 
					data-post-id="<?php echo $postID; //phpcs:ignore ?>" 
					data-avg-rating="<?php echo $rating;  //phpcs:ignore ?>"
					data-logged-in="<?php echo is_user_logged_in();  //phpcs:ignore ?>"
					data-rating-count="<?php echo $ratingCount;  //phpcs:ignore ?>"
				>

				</div>
				<i class="bi bi-hand-thumbs-up"></i>
				</div>
			</div>
			</div>
	<?php
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}
