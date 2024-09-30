<?php
/**
 * Register block file
 *
 * @package up
 */

/**
 * Register a block
 *
 * @return void
 */
function up_register_blocks() {

	$blocks = array(
		array(
			'name' => 'fancy-header',
			'options' => array(),
		),
		array(
			'name' => 'search-form',
			'options' => array(
				'render_callback' => 'up_search_form_render_cb',
			),
		),
		array(
			'name' => 'page-header',
			'options' => array(
				'render_callback' => 'up_page_header_render_cb',
			),
		),
		array(
			'name' => 'header-tools',
			'options' => array(
				'render_callback' => 'up_header_tools_render_cb',
			),
		),
		array(
			'name' => 'auth-modal',
			'options' => array(
				'render_callback' => 'up_auth_modal_render_cb',
			),
		),
		array(
			'name' => 'recipe-summary',
			'options' => array(
				'render_callback' => 'up_recipe_summary_render_cb',
			),
		),
		array(
			'name' => 'team-members-group',
			'options' => array(
				'render_callback' => 'up_team_members_group_render_cb',
			),
		),
		array(
			'name' => 'team-member',
			'options' => array(
				'render_callback' => 'up_team_member_render_cb',
			),
		),
	);

	foreach ( $blocks as $block ) {
		register_block_type( UP_PLUGIN_DIR . 'build/blocks/' . $block['name'], $block['options'] ?? array() );
	}
}
