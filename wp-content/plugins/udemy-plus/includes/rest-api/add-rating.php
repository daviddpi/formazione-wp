<?php
/**
 * Add rate rest api
 *
 * @package mytheme
 */

/**
 * Add rate function
 *
 * @param WP_REST_Request $request Rest request.
 *
 * @return array
 */
function up_rest_api_add_rate_handler( WP_REST_Request $request ): array {
	$response = array( 'status' => 'failed' );
	$params   = $request->get_json_params();

	if ( ! isset( $params['rating'], $params['postID'] )
	|| empty( $params['rating'] )
	|| empty( $params['postID'] ) ) {
		return $response;
	}

	$rating = round( floatval( $params['rating'] ), 1 );
	$postID = absint( $params['postID'] );
	$userID = get_current_user_id();

	global $wpdb;
	$wpdb->get_results( // phpcs:ignore 
		$wpdb->prepare(
			"SELECT * FROM {$wpdb->prefix}recipe_ratings
			WHERE post_id=%d AND user_id=%d",
			$postID, $userID
		)
	);

	if ( $wpdb->num_rows > 0 ) {
		return $response;
	}

	$insert = $wpdb->insert( // phpcs:ignore 
		"{$wpdb->prefix}recipe_ratings",
		array(
			'post_id' => $postID,
			'rating' => $rating,
			'user_id' => $userID,
		),
		array( '%d', '%f', '%d' )
	);

	if ( $insert === false ) {
		return $response = array(
			'status' => 'Insert failed',
		);
	}

	$avgRating = round($wpdb->get_var($wpdb->prepare( // phpcs:ignore 
		"SELECT AVG(`rating`)
		FROM {$wpdb->prefix}recipe_ratings
		WHERE post_id=%d",
		$postID
	)), 1);

	update_post_meta( $postID, 'recipe_ratings', $avgRating );

	do_action( 'recipe_rated', array(
		'postID' => $postID,
		'rating' => $rating,
		'userID' => $userID,
	) );

	$response = array(
		'status' => 'success',
		'rating' => $avgRating,
	);

	return $response;
}
