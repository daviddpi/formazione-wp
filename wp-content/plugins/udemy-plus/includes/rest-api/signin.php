<?php
/**
 * Signin rest api
 *
 * @package mytheme
 */

/**
 * Signin function
 *
 * @param WP_REST_Request $request Rest request.
 *
 * @return array
 */
function up_rest_api_signin_handler( WP_REST_Request $request ): array {
	$response = array( 'status' => 'failed' );
	$params   = $request->get_json_params();

	if ( ! isset( $params['user_login'], $params['password'] )
	|| empty( $params['user_login'] )
	|| empty( $params['password'] ) ) {
		return $response;
	}

	$email    = sanitize_email( $params['user_login'] );
	$password = sanitize_text_field( $params['password'] );

	$user = wp_signon( array(
		'user_login' => $email,
		'user_password' => $password,
		'remember' => true,
	) );

	if ( is_wp_error( $user ) ) {
		return $response;
	}

	$response = array( 'status' => 'success' );

	return $response;
}
