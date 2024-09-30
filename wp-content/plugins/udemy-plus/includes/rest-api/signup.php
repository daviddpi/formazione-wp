<?php
/**
 * Signup rest api
 *
 * @package mytheme
 */

/**
 * Signup function
 *
 * @param WP_REST_Request $request Rest request.
 *
 * @return array
 */
function up_rest_api_signup_handler( WP_REST_Request $request ): array {
	$response = array( 'status' => 'failed' );
	$params   = $request->get_json_params();

	if ( ! isset( $params['email'], $params['username'], $params['password'] )
	|| empty( $params['email'] )
	|| empty( $params['username'] )
	|| empty( $params['password'] ) ) {
		return $response;
	}

	$email    = sanitize_email( $params['email'] );
	$username = sanitize_text_field( $params['username'] );
	$password = sanitize_text_field( $params['password'] );

	if ( username_exists( $username ) || ! is_email( $email ) || email_exists( $email ) ) {
		return $response;
	}

	$userId = wp_insert_user( array(
		'user_login' => $username,
		'user_pass' => $password,
		'user_email' => $email,
	) );

	if ( is_wp_error( $userId ) ) {
		return $response;
	}

	wp_new_user_notification( $userId, null, 'user' );
	wp_set_current_user( $userId );
	wp_set_auth_cookie( $userId );

	$user = get_user_by( 'id', $userId );

	do_action( 'wp_login', $username, $user );
	$response = array( 'status' => 'success' );

	return $response;
}
