<?php

/**
 * Custom Post Types
 *
 * NOTE: When defining a rewrite slug for a CPT, make it as short as possible.
 * Then use the redirects in .htaccess to redirect this slug with no CPT postname
 * to the actual listing page URL.
 *
 * @package	Pilau_Starter
 * @since	0.1
 */


add_action( 'init', 'pilau_register_post_types', 0 );
/**
 * Register custom post types
 *
 * @since	0.1
 * @return	void
 */
function pilau_register_post_types() {


	/*
	register_post_type(
		'project', array(
			'label'					=> _x( 'projects', 'post type plural name' ),
			'labels'				=> array(
				'name'					=> _x( 'Projects', 'post type general name' ),
				'singular_name'			=> _x( 'Project', 'post type singular name' ),
				'menu_name'				=> _x( 'Projects', 'admin menu' ),
				'name_admin_bar'		=> _x( 'Project', 'add new on admin bar' ),
				'add_new'				=> _x( 'Add New', 'project' ),
				'add_new_item'			=> __( 'Add New Project' ),
				'new_item'				=> __( 'New Project' ),
				'edit_item'				=> __( 'Edit Project' ),
				'view_item'				=> __( 'View Project' ),
				'all_items'				=> __( 'All Projects' ),
				'search_items'			=> __( 'Search Projects' ),
				'parent_item_colon'		=> __( 'Parent Projects:' ),
				'not_found'				=> __( 'No Projects found.' ),
				'not_found_in_trash'	=> __( 'No Projects found in Trash.' )
			),
			'public'				=> true,
			'publicly_queryable'	=> true,
			'show_ui'				=> true,
			'show_in_nav_menus'		=> true,
			'show_in_menu'			=> true,
			'show_in_admin_bar'		=> true,
			'menu_position'			=> 20, // Below Pages
			'menu_icon'				=> 'dashicons-portfolio', // @link https://developer.wordpress.org/resource/dashicons/
			'query_var'				=> true,
			'rewrite'				=> array( 'slug' => 'project', 'with_front' => false ),
			'capability_type'		=> 'post',
			'has_archive'			=> false,
			'hierarchical'			=> false, // Set to true to allow ordering
			'supports'				=> array( 'title', 'editor', 'custom-fields', 'thumbnail', 'revisions' ),
			'taxonomies'			=> array( 'projecttype' ),
		)
	);
	*/


	// Generated by Pilau Init
	//[[custom-post-types]]


}


/* Managing CPT ancestors
 *****************************************************************************************/


add_action( 'after_setup_theme', 'pilau_define_cpt_ancestors' );
/**
 * Define CPT ancestors
 *
 * To situate non-page post types within the page hierarchy:
 * [post_type]	=> array( [parent ID], [grandparent ID], etc. )
 *
 * Also includes post, as a non-hierarchical core post type
 *
 * @since	0.2
 */
function pilau_define_cpt_ancestors() {
	global $pilau_cpt_ancestors;
	$pilau_cpt_ancestors = array(
	);
}


/**
 * Get the ancestors of a CPT
 *
 * @since	0.2
 * @param	int|WP_Post		$post	Post ID or post object
 * @return	array
 */
function pilau_get_cpt_ancestors( $post ) {
	global $pilau_cpt_ancestors;
	if ( ( ! is_int( $post ) && ! is_object( $post ) ) || ! array_key_exists( get_post_type( $post ), $pilau_cpt_ancestors ) ) {
		return array();
	}
	return $pilau_cpt_ancestors[ get_post_type( $post ) ];
}


/**
 * Check if a given page is an ancestor of the current page, accounting for CPTs
 *
 * @since	0.2
 * @param	int		$page_id
 * @return	bool
 */
function pilau_is_ancestor( $page_id ) {
	$is_ancestor = false;
	if ( get_post_type() == 'page' ) {
		$is_ancestor = in_array( $page_id, get_post_ancestors( PILAU_PAGE_ID_CURRENT ) );
	} else {
		$is_ancestor = in_array( $page_id, pilau_get_cpt_ancestors( PILAU_PAGE_ID_CURRENT ) );
	}
	return $is_ancestor;
}


/**
 * Back link for single post
 *
 * @since	0.1
 * @param	string	$link_text
 * @return	void
 */
function pilau_post_back_link( $link_text = null ) {
	global $post;
	if ( ! $link_text ) {
		$link_text = __( 'Back' );
	}
	echo '<p class="post-back-link"><a href="' . get_permalink( pilau_get_cpt_ancestors( $post )[0] ) . '">&laquo; ' . $link_text . '</a></p>';
}


add_filter( 'nav_menu_css_class', 'pilau_cpt_nav_menu_css_class', 10, 2 );
/**
 * Custom classes for nav menus
 *
 * @since	0.1
 */
function pilau_cpt_nav_menu_css_class( $classes, $item ) {
	if ( get_post_type() != 'page' && pilau_is_ancestor( $item->object_id ) ) {
		$classes[] = 'current-menu-ancestor';
	}
	return $classes;
}
