<?php
/**
 * Enqueue scripts
 *
 * @package mytheme
 */

/**
 * Register script
 *
 * @return void
 */
function up_enqueue_scripts() {
	$authURLs = json_encode( // phpcs:ignore WordPress.WP.AlternativeFunctions.json_encode_json_encode
		array(
			'signup' => esc_url_raw( rest_url( 'up/v1/signup' ) ),
			'signin' => esc_url_raw( rest_url( 'up/v1/signin' ) ),
		),
	);

	?>
		<script>
			const up_auth_rest = <?php echo $authURLs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> 
		</script>
	<?php
}