<?php
/**
 * Render Search form
 *
 * @package up
 */

/**
 * Render function search form
 *
 * @param array $atts Attribute.
 * @return string
 */
function up_search_form_render_cb( array $atts ): string {

	$bgColor   = esc_attr( $atts['bgColor'] );
	$textColor = esc_attr( $atts['textColor'] );
	$styleAttr = "background-color: {$bgColor}; color: {$textColor};";
	ob_start();
	?>
	<div style="<?php echo esc_html( $styleAttr ); ?>" class="wp-block-udemy-plus-search-form">
		<h1>
			<?php esc_attr_e( 'Search', 'up' ); ?>:
			<?php the_search_query(); ?>
		</h1>
		<form action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<input type="text" placeholder="<?php esc_attr_e( 'Search', 'up' ); ?>" name="s" value="<?php the_search_query(); ?>" />
			<div class="btn-wrapper">
				<button type="submit" style="<?php echo esc_html( $styleAttr ); ?>">
					Search
				</button>
			</div>
		</form>
	</div>
	<?php
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}
