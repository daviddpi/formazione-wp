<?php
/**
 * Render page header
 *
 * @package up
 */

/**
 * Render function page header
 *
 * @param array $atts Attribute.
 * @return string
 */
function up_page_header_render_cb( array $atts ): string {

	$heading = esc_html( $atts['content'] ?? '' );
	if ( $atts['showCategory'] ) {
		$heading = get_the_archive_title();
	}

	ob_start();
	?>
		<div class="wp-block-udemy-plus-page-header">
			<div class="inner-page-header">
				<h1><?php echo $heading; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h1> 

			</div>
		</div>
	<?php
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}
