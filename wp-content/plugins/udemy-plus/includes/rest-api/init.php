<?php
/**
 * Init rest api
 *
 * @package mytheme
 */

/**
 * Register rest api
 *
 * @return void
 */
function up_rest_api_init() {
	register_rest_route( 'up/v1', '/signup', array(
		'methods' => 'POST',
		'callback' => 'up_rest_api_signup_handler',
		'permission_callback' => '__return_true',
	) );

	register_rest_route( 'up/v1', '/signin', array(
		'methods' => 'POST',
		'callback' => 'up_rest_api_signin_handler',
		'permission_callback' => '__return_true',
	) );

	register_rest_route( 'up/v1', '/rate', array(
		'methods' => 'POST',
		'callback' => 'up_rest_api_add_rate_handler',
		'permission_callback' => 'is_user_logged_in',
	) );
}
