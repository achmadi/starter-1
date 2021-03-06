<?php

/**
 * Custom taxonomies
 *
 * @package	Pilau_Starter
 * @since	0.1
 */

add_action( 'init', 'pilau_register_taxonomies', 0 );
/**
 * Register custom taxonomies
 *
 * @since	0.1
 */
function pilau_register_taxonomies() {

	/*
	register_taxonomy(
		'projecttype', 'project',
		array(
			'pilau_required'		=> true,
			'pilau_multiple'		=> false,
			'pilau_hierarchical'	=> false,
			'hierarchical'			=> true,
			'query_var'				=> true,
			'rewrite'				=> true,
			'show_admin_column'		=> true,
			'labels'				=> array(
				'name'				=> __( 'Project types' ),
				'singular_name'		=> __( 'Project type' ),
				'search_items'		=> __( 'Search Project types' ),
				'all_items'			=> __( 'All Project types' ),
				'edit_item'			=> __( 'Edit Project type' ),
				'update_item'		=> __( 'Update Project type' ),
				'add_new_item'		=> __( 'Add New Project type' ),
				'new_item_name'		=> __( 'New Project type Name' ),
			)
		)
	);
	*/

}