<?php
/**
 * Cuisine fields file
 *
 * @package up
 */

/**
 * Cuisine add form fields
 *
 * @return void
 */
function up_cuisine_add_form_fields() {
	?>
		<div class="form-field">
			<label for="up_more_info_url"><?php _e( 'More Info URL', 'up' ); // phpcs:ignore WordPress.Security.EscapeOutput.UnsafePrintingFunction ?></label> 
			<input type="text" name="up_more_info_url" />
			<p><?php _e( 'A URL a user can click to learn more information about this cuisine' ); // phpcs:ignore WordPress.Security.EscapeOutput.UnsafePrintingFunction ?></p>
		</div>
	<?php
}

/**
 * Cuisine edit form fields
 *
 * @param WP_Term $term Value of fields.
 * @return void
 */
function up_cuisine_edit_form_fields( WP_Term $term ) {

	$url = get_term_meta( $term->term_id, 'more_info_url', true );

	?>
		<tr class="form-field">
			<th>
				<label for="up_more_info_url"><?php _e( 'More Info URL', 'up' ); // phpcs:ignore WordPress.Security.EscapeOutput.UnsafePrintingFunction ?></label> 
			</th>
			<td>
				<input type="text" name="up_more_info_url" value=" <?php echo $url; // phpcs:ignore ?>"/>
				<p class="description"><?php _e( 'A URL a user can click to learn more information about this cuisine' ); // phpcs:ignore WordPress.Security.EscapeOutput.UnsafePrintingFunction ?></p>			
			</td>
		</tr>
	<?php
}
