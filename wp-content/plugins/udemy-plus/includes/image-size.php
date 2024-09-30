<?php
/**
 * Image size
 *
 * @package up
 */

/**
 * Image size
 *
 * @param mixed $sizes Sizes of image.
 * @return array
 */
function up_custom_image_size( mixed $sizes ): array {
	return array_merge($sizes, array(
		'teamMember' => __( 'Team Member', 'up' ),
	));
}
