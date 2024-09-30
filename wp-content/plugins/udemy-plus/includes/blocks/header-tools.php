<?php
/**
 * Render header tool
 *
 * @package up
 */

/**
 * Render function header tool
 *
 * @param array $atts Attribute.
 * @return string
 */
function up_header_tools_render_cb( array $atts ): string {
	$user      = wp_get_current_user();
	$name      = $user->exists() ? $user->user_login : 'Sign in';
	$openClass = $user->exists() ? '' : 'open-modal';
	ob_start();
	?>
		<div class="wp-block-udemy-plus-header-tools">
			<?php if ( $atts['showAuth'] ) { ?>
			<a class="signin-link <?php echo esc_html( $openClass ); ?>" href="#">
				<div class="signin-icon">
					<i class="bi bi-person-circle"></i>
				</div>
				<div class="signin-text">
					<small>Hello, <?php echo esc_html( $name ); ?></small>
					My Account
				</div>
			</a>
			<?php } ?>
		</div>
	<?php
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}
