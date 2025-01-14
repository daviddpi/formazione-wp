<?php
/**
 * Register custom post type Recipe
 *
 * @package up
 */

/**
 * Register a custom post type Recipe
 *
 * @return void
 */
function up_recipe_post_type() {
	$labels = array(
		'name'                  => _x( 'Recipes', 'Post type general name', 'up' ),
		'singular_name'         => _x( 'Recipe', 'Post type singular name', 'up' ),
		'menu_name'             => _x( 'Recipes', 'Admin Menu text', 'up' ),
		'name_admin_bar'        => _x( 'Recipe', 'Add New on Toolbar', 'up' ),
		'add_new'               => __( 'Add New', 'up' ),
		'add_new_item'          => __( 'Add New Recipe', 'up' ),
		'new_item'              => __( 'New Recipe', 'up' ),
		'edit_item'             => __( 'Edit Recipe', 'up' ),
		'view_item'             => __( 'View Recipe', 'up' ),
		'all_items'             => __( 'All Recipes', 'up' ),
		'search_items'          => __( 'Search Recipes', 'up' ),
		'parent_item_colon'     => __( 'Parent Recipes:', 'up' ),
		'not_found'             => __( 'No Recipes found.', 'up' ),
		'not_found_in_trash'    => __( 'No Recipes found in Trash.', 'up' ),
		'featured_image'        => _x( 'Recipe Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'up' ),
		'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'up' ),
		'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'up' ),
		'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'up' ),
		'archives'              => _x( 'Recipe archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'up' ),
		'insert_into_item'      => _x( 'Insert into Recipe', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'up' ),
		'uploaded_to_this_item' => _x( 'Uploaded to this Recipe', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'up' ),
		'filter_items_list'     => _x( 'Filter Recipes list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'up' ),
		'items_list_navigation' => _x( 'Recipes list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'up' ),
		'items_list'            => _x( 'Recipes list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'up' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'recipe' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 20,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields' ),
		'show_in_rest'       => true,
		'description'        => __( 'A custom post type for recipes', 'up' ),
		'taxonomies'         => array( 'category', 'post_tag' ),
	);

	register_post_type( 'recipe', $args );

	register_taxonomy( 'cuisine', 'recipe', array(
		'label' => __( 'Cuisine', 'up' ),
		'rewrite' => array( 'slug' => 'cuisine' ),
		'show_in_rest' => true,
	) );

	register_term_meta( 'cuisine', 'more_info_url', array(
		'type' => 'string',
		'description' => __( 'A URL for more information on a cuisine', 'up' ),
		'single' => true,
		'show_in_rest' => true,
		'default' => '#',
	) );

	register_post_meta( 'recipe', 'recipe_ratings', array(
		'type' => 'number',
		'description' => __( 'The rating for a recipe', 'up' ),
		'single' => true,
		'default' => 0,
		'show_in_rest' => true,
	));
}
